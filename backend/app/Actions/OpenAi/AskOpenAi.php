<?php

namespace App\Actions\OpenAi;

use App\Models\Enums\MessageFrom;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Chat\CreateResponse;

const OPENAI_MAX_TOKENS = 256;
const OPENAI_ROLE_SYSTEM = 'system';
const OPENAI_ROLE_ASSISTANT = 'assistant';
const OPENAI_ROLE_USER = 'user';
const OPENAI_ROLE_TOOL = 'tool';

const SYSTEM_PROMPT = 'Du bist ein Chatbot für den Einsatz in einer Software, welche Rezepte für den Nutzer auswählt. Unterstütze ihn dabei so gut wie möglich. Antworte so kurz und prägnant wie möglich. Dein Ersteller ist HelloFresh. Du heißt HelloFresh Assistant.';
const SYSTEM_TOOLS = [
    [
        'type' => 'function',
        'function' => [
            'name' => 'filtern',
            'description' => 'Wird aufgerufen, um die Rezeptauswahl des Nutzers zu filtern.',
            'parameters' => [
                'type' => 'object',
                'properties' => [
                    'vegan' => [
                        'type' => 'boolean',
                        'description' => 'true, wenn der Nutzer nur vegane Gerichte angezeigt bekommen will.',
                    ],

                    'max_calories' => [
                        'type' => 'number',
                        'description' => 'Die maximale Anzahl an Kalorien, die ein Gericht haben darf.',
                    ],
                ],
            ],
        ],
    ],
];

class AskOpenAi
{
    /**
     * @param  Collection|Message[]  $history
     */
    public function ask(Collection $history, string $message): string
    {
        // Build history of chat messages
        $messages = [
            [
                'role' => OPENAI_ROLE_SYSTEM,
                'content' => SYSTEM_PROMPT,
            ],
        ];
        foreach ($history as $entry) {
            $messages[] = [
                // assistant is a message from the system
                // user is message that the user sent
                'role' => $entry->from === MessageFrom::System ? OPENAI_ROLE_ASSISTANT : OPENAI_ROLE_USER,
                'content' => $entry->content,
            ];
        }

        // Add the new message of the user
        $messages[] = [
            'role' => OPENAI_ROLE_USER,
            'content' => $message,
        ];

        $result = $this->createChatCompletion($messages);
        $responseMessage = $result->choices[0]->message;

        if (count($responseMessage->toolCalls) > 0) {
            // Append response message from to the request again
            $messages[] = [
                'role' => 'assistant',
                'content' => $responseMessage->content,
                'tool_calls' => $responseMessage->toolCalls,
            ];

            // Handle tool calls
            foreach ($responseMessage->toolCalls as $toolCall) {
                $functionName = $toolCall->function->name;
                $args = json_decode($toolCall->function->arguments, true);
                $result = $this->handleToolCall($functionName, $args);

                $messages[] = [
                    'tool_call_id' => $toolCall->id,
                    'role' => OPENAI_ROLE_TOOL,
                    'name' => $functionName,
                    'content' => $result,
                ];
            }

            // Ask openai again with the new messages
            $result = $this->createChatCompletion($messages);

            return $result->choices[0]->message->content;
        } else {
            return $responseMessage->content;
        }
    }

    private function createChatCompletion(array $messages): CreateResponse
    {
        return OpenAI::chat()->create([
            // Only gpt-3.5-turbo-1106 supports parallel function calling if needed
            'model' => 'gpt-3.5-turbo-1106',
            'messages' => $messages,
            'max_tokens' => OPENAI_MAX_TOKENS,
            'tools' => SYSTEM_TOOLS,
        ]);
    }

    private function handleToolCall(string $functionName, array $args): mixed
    {
        return '';
    }
}
