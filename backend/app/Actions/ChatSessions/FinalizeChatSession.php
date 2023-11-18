<?php

namespace App\Actions\ChatSessions;

use App\Models\ChatSession;

class FinalizeChatSession
{
    public function finalize(ChatSession $chatSession): void
    {
        $chatSession->update([
            'finalized' => true,
        ]);
    }
}
