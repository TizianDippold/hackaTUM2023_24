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
        $chatSession = new ChatSession();
        // Workaround so that we can have an empty object (not list!) in the database by default
        $chatSession->filter = json_decode('{}');
        $chatSession->save();
        // Load database default values
        $chatSession->refresh();
        $this->systemPromptCreator->create($chatSession);

        return $chatSession;
    }
}
