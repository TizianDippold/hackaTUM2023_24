<?php

namespace App\Actions\Messages;

use App\Actions\OpenAi\AskOpenAi;
use App\Models\ChatSession;
use App\Models\Message;

class SendMessage
{
    public function send(ChatSession $chatSession, string $message): Message
    {
        $chatSession->load('messages');

        $asker = app(AskOpenAi::class, [
            'history' => $chatSession->messages,
        ]);

        // Ask openai for an answer, with the chat messages that were already sent in this conversation
        $asker->ask($message);

        $asker->addNewMessagesToChatSession($chatSession);

        // This is definitely not null because the user did ask something
        return $asker->getLastCreatedMessage();
    }
}
