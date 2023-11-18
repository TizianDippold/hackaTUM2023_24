<?php

namespace App\Http\Controllers;

use App\Actions\ChatSessions\CreateChatSession;
use App\Actions\ChatSessions\FinalizeChatSession;
use App\Actions\ChatSessions\GetChatSessionResults;
use App\Http\Resources\ChatSessionResource;
use App\Http\Resources\RecipeCollection;
use App\Models\ChatSession;

class ChatSessionApiController extends Controller
{
    public function __construct(
        private readonly CreateChatSession $createChatSession,
        private readonly FinalizeChatSession $finalizeChatSession,
        private readonly GetChatSessionResults $getChatSessionResults,
    ) {
    }

    /**
     * Create chat session
     *
     * @apiResource App\Http\Resources\ChatSessionResource
     *
     * @apiResourceModel App\Models\ChatSession
     */
    public function store()
    {
        return new ChatSessionResource($this->createChatSession->create());
    }

    /**
     * Finalize chat session
     *
     * @apiResource App\Http\Resources\ChatSessionResource
     *
     * @apiResourceModel App\Models\ChatSession
     */
    public function finalize(ChatSession $chatSession)
    {
        $this->finalizeChatSession->finalize($chatSession);

        return new ChatSessionResource($chatSession);
    }

    /**
     * Get chat session results
     *
     * @apiResource App\Http\Resources\RecipeCollection
     *
     * @apiResourceModel App\Models\Recipe
     */
    public function getResults(ChatSession $chatSession)
    {
        return new RecipeCollection($this->getChatSessionResults->getResults($chatSession));
    }
}
