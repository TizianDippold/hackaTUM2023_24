<?php

namespace App\Actions\ChatSessions;

use App\Models\ChatSession;
use App\Models\Recipe;

class LikeRecipe
{
    public function like(ChatSession $chatSession, Recipe $recipe): void
    {
        $chatSession->likedRecipes()->attach($recipe);
    }
}
