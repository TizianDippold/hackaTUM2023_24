<?php

namespace App\Actions\OpenAi;

use App\Models\Enums\MessageFrom;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;

const OPENAI_MAX_TOKENS = 128;

class AskOpenAi
{
    /**
     * @param  Collection|Message[]  $history
     */
    public function ask(Collection $history, string $message): string
    {
        // Build history of chat messages
        $messages = [];
        foreach ($history as $entry) {
            $messages[] = [
                // assistant is a message from the system
                // user is message that the user sent
                'role' => $entry->from === MessageFrom::System ? 'assistant' : 'user',
                'content' => $entry->content,
            ];
        }

        // Add the new message of the user
        $messages[] = [
            'role' => 'user',
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
