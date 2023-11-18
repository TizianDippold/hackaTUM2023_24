<?php

namespace App\Actions\OpenAi;

use App\Models\ChatSession;
use App\Models\Enums\MessageFrom;
use App\Models\Ingredient;

const SYSTEM_PROMPT = 'You are a chatbot for a software which selects recipes for the user. You should support the user as good as possible. Answer as shortly and precisely as possible. Your creator ist HelloFresh. Your name is HelloFresh Assistant.';

class CreateOpenAiSystemPrompt
{
    public function create(ChatSession $chatSession): void
    {
        $chatSession->messages()->create([
            'from' => MessageFrom::System,
            'content' => SYSTEM_PROMPT,
        ]);

        $chatSession->messages()->create([
            'from' => MessageFrom::System,
            'content' => 'When thinking about ingredients, also include variants or processed products of the ingredient that could or could not lead to an allergic reaction. The following ingredients are available: '.(Ingredient::get()
                ->map(fn (Ingredient $ingredient) => $ingredient->name)
                ->join(', ')),
        ]);
    }
}
