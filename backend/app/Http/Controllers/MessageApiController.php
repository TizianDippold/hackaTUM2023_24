<?php

namespace App\Http\Controllers;

use App\Actions\Messages\SendMessage;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\ChatSession;

class MessageApiController extends Controller
{
    public function __construct(private readonly SendMessage $sendMessage)
    {
    }

    /**
     * Send chat message
     *
     * @apiResource App\Http\Resources\MessageResource
     *
     * @apiResourceModel App\Models\Message
     */
    public function store(StoreMessageRequest $request, ChatSession $chatSession)
    {
        $answer = $this->sendMessage->send($chatSession, $request->validated('message'));

        return new MessageResource($answer);
    }
}
