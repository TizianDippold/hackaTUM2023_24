<?php

namespace App\Actions\ChatSessions;

use App\Models\ChatSession;

class CreateChatSession
{
    public function create(): ChatSession
    {
        return ChatSession::create();
    }
}
