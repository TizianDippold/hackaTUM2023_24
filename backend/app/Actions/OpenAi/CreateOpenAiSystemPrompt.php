<?php

namespace App\Actions\OpenAi;

use App\Models\ChatSession;
use App\Models\Enums\MessageFrom;
use App\Models\Message;

const SYSTEM_PROMPT = 'Du bist ein Chatbot für den Einsatz in einer Software, welche Rezepte für den Nutzer auswählt. Unterstütze ihn dabei so gut wie möglich. Antworte so kurz und prägnant wie möglich. Dein Ersteller ist HelloFresh. Du heißt HelloFresh Assistant.';

class CreateOpenAiSystemPrompt
{
    public function create(ChatSession $chatSession): Message
    {
        return $chatSession->messages()->create([
            'from' => MessageFrom::System,
            'content' => SYSTEM_PROMPT,
        ]);
    }
}
