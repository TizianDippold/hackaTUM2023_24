<?php

namespace App\Actions\OpenAi;

use App\Models\ChatSession;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseToolCall;

const OPENAI_MAX_TOKENS = 256;
const OPENAI_ROLE_SYSTEM = 'system';
const OPENAI_ROLE_ASSISTANT = 'assistant';
const OPENAI_ROLE_USER = 'user';
const OPENAI_ROLE_TOOL = 'tool';

// Only gpt-3.5-turbo-1106 supports parallel function calling if needed
const SYSTEM_MODEL = 'gpt-4-1106-preview';

class AskOpenAi
{
    /**
     * @param  Collection|Message[]  $history
     */
    private readonly Collection $history;

    private array $oldMessages = [];

    private array $newMessages = [];

    private ?Message $lastCreatedMessage = null;

    public function __construct(
        private readonly OpenAiMessageTransformer $messageTransformer,
        private readonly SystemToolsGenerator $toolsGenerator,
        private readonly ChatSession $chatSession,
        Collection $history
    ) {
        $this->history = $history;
    }

    public function ask(string $message): string
    {
        $this->buildOldMessages();

        // Add the new message of the user
        $this->newMessage([
            'role' => OPENAI_ROLE_USER,
            'content' => $message,
        ]);

        $result = $this->createChatCompletion();
        $responseMessage = $result->choices[0]->message;

        // If tool calls are required, execute them
        if (count($responseMessage->toolCalls) > 0) {
            // Append tool call requests to the request
            $this->newMessage([
                'role' => 'assistant',
                'content' => $responseMessage->content,
                'tool_calls' => $responseMessage->toolCalls,
            ]);

            $this->handleToolCalls($responseMessage->toolCalls);

            // Ask openai again with the answers from the tools
            $result = $this->createChatCompletion();

            $responseMessage = $result->choices[0]->message;
        }

        // No more tool call required, add answer to the new messages and return the response
        $this->newMessage([
            'role' => OPENAI_ROLE_ASSISTANT,
            'content' => $responseMessage->content,
        ]);

        return $responseMessage->content;
    }

    private function buildOldMessages(): void
    {
        // Build history of chat messages
        foreach ($this->history as $entry) {
            $this->oldMessages[] = $this->messageTransformer->fromDatabase($entry);
        }
    }

    private function newMessage(array $message): void
    {
        $this->newMessages[] = $message;
    }

    private function createChatCompletion(): CreateResponse
    {
        return OpenAI::chat()->create([
            'model' => SYSTEM_MODEL,
            'messages' => array_merge($this->oldMessages, $this->newMessages),
            'max_tokens' => OPENAI_MAX_TOKENS,
            'tools' => $this->toolsGenerator->generate(),
        ]);
    }

    /**
     * @param  array|CreateResponseToolCall[]  $toolCalls
     */
    private function handleToolCalls(array $toolCalls): void
    {
        foreach ($toolCalls as $toolCall) {
            $functionName = $toolCall->function->name;
            $args = json_decode($toolCall->function->arguments, true);
            $result = $this->handleToolCall($functionName, $args);

            // Append result of tool call to the request again
            $this->newMessage([
                'role' => OPENAI_ROLE_TOOL,
                'tool_call_id' => $toolCall->id,
                'name' => $functionName,
                'content' => $result,
            ]);
        }
    }

    private function handleToolCall(string $functionName, array $args): string
    {
        if ($functionName === 'filter') {
            // Merge filter arguments with the chat session filter
            $this->chatSession->filter = array_merge($this->chatSession->filter->toArray(), $args);
            $this->chatSession->save();
        } elseif ($functionName === 'without_ingredients') {
            $this->chatSession->filter['without_ingredients'] = array_merge(
                $this->chatSession->filter['without_ingredients'] ?? [],
                $args['ingredients'],
            );
            $this->chatSession->save();
        }

        return '';
    }

    public function addNewMessagesToChatSession(ChatSession $chatSession): void
    {
        foreach ($this->newMessages as $message) {
            $this->lastCreatedMessage = $chatSession->messages()->create(
                $this->messageTransformer->toDatabase($message)
            );
        }

        // The new messages were saved, therefore they become old messages
        $this->oldMessages = array_merge($this->oldMessages, $this->newMessages);
        $this->newMessages = [];
    }

    public function getLastCreatedMessage(): ?Message
    {
        return $this->lastCreatedMessage;
    }
}
