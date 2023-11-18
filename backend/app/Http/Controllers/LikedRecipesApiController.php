<?php

namespace App\Http\Controllers;

use App\Actions\ChatSessions\LikeRecipe;
use App\Http\Requests\LikeRecipeRequest;
use App\Http\Resources\ChatSessionResource;
use App\Models\ChatSession;
use App\Models\Recipe;

class LikedRecipesApiController extends Controller
{
    public function __construct(private readonly LikeRecipe $likeRecipe)
    {
    }

    /**
     * Like a recipe
     *
     * @apiResource App\Http\Resources\ChatSessionResource
     *
     * @apiResourceModel App\Models\ChatSession
     */
    public function store(LikeRecipeRequest $request, ChatSession $chatSession)
    {
        $recipe = Recipe::findOrFail($request->validated('recipe_id'));
        $this->likeRecipe->like($chatSession, $recipe);

        return new ChatSessionResource($chatSession->load('likedRecipes'));
    }
}
