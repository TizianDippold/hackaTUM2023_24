<?php

namespace App\Actions\Messages;

use App\Actions\OpenAi\AskOpenAi;
use App\Models\ChatSession;
use App\Models\Enums\MessageFrom;
use App\Models\Message;

class SendMessage
{
    public function __construct(private readonly AskOpenAi $askOpenAi)
    {
    }

    public function send(ChatSession $chatSession, string $message): Message
    {
        $chatSession->load('messages');

        // Ask openai for an answer, with the chat messages that were already sent in this conversation
        $answer = $this->askOpenAi->ask($chatSession->messages, $message);

        // Insert message that the user wrote into the database
        $chatSession->messages()->create([
            'from' => MessageFrom::User,
            'content' => $message,
        ]);

        // Insert the answer from openai into the database
        return $chatSession->messages()->create([
            'from' => MessageFrom::System,
            'content' => $answer,
        ]);
    }
}
