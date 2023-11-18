<?php

namespace App\Http\Controllers;

use App\Actions\ChatSessions\CreateChatSession;
use App\Http\Resources\ChatSessionResource;

class ChatSessionApiController extends Controller
{
    public function __construct(private readonly CreateChatSession $createChatSession)
    {
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
}
