<?php

namespace App\Actions\Messages;

use App\Models\ChatSession;
use App\Models\Enums\MessageFrom;
use App\Models\Message;

class SendMessage
{
    public function send(ChatSession $chatSession, string $message): Message
    {
        // TODO: Implementation
        return $chatSession->messages()->create([
            'from' => MessageFrom::System,
            'content' => $message,
        ]);
    }
}
