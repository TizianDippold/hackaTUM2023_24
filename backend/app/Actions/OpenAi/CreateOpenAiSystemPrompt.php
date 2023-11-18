<?php

namespace App\Actions\OpenAi;

use App\Models\ChatSession;
use App\Models\Enums\MessageFrom;
use App\Models\Ingredient;

const SYSTEM_PROMPT = 'Imagine you are a chatbot created by HelloFresh to assist users in selecting recipes. Your primary goal is to support users effectively by providing short concise and precise answers. Use as little words as possible. Your name is HelloFresh Assistant. Respond accordingly.';

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
            'content' => 'When considering ingredients, take into account both variants and processed products of the ingredient that may or may not trigger allergic reactions. The available ingredients are:'.(Ingredient::get()
                ->map(fn (Ingredient $ingredient) => $ingredient->name)
                ->join(', ')),
        ]);
    }
}
