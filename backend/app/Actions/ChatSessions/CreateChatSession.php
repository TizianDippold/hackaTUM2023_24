<?php

namespace App\Actions\ChatSessions;

use App\Actions\OpenAi\CreateOpenAiSystemPrompt;
use App\Models\ChatSession;

class CreateChatSession
{
    public function __construct(private readonly CreateOpenAiSystemPrompt $systemPromptCreator)
    {
    }

    public function create(): ChatSession
    {
        $chatSession = ChatSession::create();
        $this->systemPromptCreator->create($chatSession);

        return $chatSession;
    }
}
