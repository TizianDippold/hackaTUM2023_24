<?php

namespace App\Actions\OpenAi;

use App\Models\Enums\MessageFrom;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;

const OPENAI_MAX_TOKENS = 256;
const OPENAI_ROLE_SYSTEM = 'system';
const OPENAI_ROLE_ASSISTANT = 'assistant';
const OPENAI_ROLE_USER = 'user';

const SYSTEM_PROMPT = 'Du bist ein Chatbot für den Einsatz in einer Software, welche Rezepte für den Nutzer auswählt. Unterstütze ihn dabei so gut wie möglich. Antworte so kurz und prägnant wie möglich. Dein Ersteller ist HelloFresh. Du heißt HelloFresh Assistant.';

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

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
            'max_tokens' => OPENAI_MAX_TOKENS,
        ]);

        return $result->choices[0]->message->content;
    }
}
