<?php

namespace App\Actions\ChatSessions;

use App\Models\ChatSession;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;

const OPENAI_RANKING_MODEL = 'gpt-4-1106-preview';
const RANKING_SYSTEM_PROMPT = 'As an engine generating a JSON response for the user, your task is to provide the top 10 ranked recipes. The criteria include a user\'s liked recipes, a set of preference filters, and a list of available recipes. Emphasize the following: Only choose recipes from the given list. Do not create new recipes. Respond with a JSON format: {"place_1": RECIPE_ID, "place_2": RECIPE_ID, ...}, where RECIPE_ID is the id of the recipe in the respective ranking position.';

class GetChatSessionResults
{
    /**
     * @return array|ChatSession[]
     */
    public function getResults(ChatSession $chatSession): array
    {
        $likedRecipes = $chatSession->likedRecipes()
            ->with('tags', 'ingredients')
            ->get();

        $filter = $chatSession->filter->toArray();
        $recipes = Recipe::filter($filter)
            ->with('tags', 'ingredients')
            ->get();

        $openAiRanking = $this->getOpenAiRanking($recipes, $likedRecipes, $filter);

        $result = [];
        foreach ($openAiRanking as $recipeId) {
            $result[] = $recipes->firstWhere('id', $recipeId);
        }

        return $result;
    }

    /**
     * @param  Collection|Recipe[]  $recipes
     * @return array|int[]
     */
    private function getOpenAiRanking(Collection $recipes, Collection $likedRecipes, array $filter): array
    {
        $response = OpenAI::chat()->create([
            'model' => OPENAI_RANKING_MODEL,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => RANKING_SYSTEM_PROMPT,
                ],
                [
                    'role' => 'user',
                    'content' => json_encode([
                        'liked' => $likedRecipes->map(fn (Recipe $recipe) => $recipe->toArray())->toArray(),
                        'filter' => $filter,
                        'recipes' => $recipes->map(fn (Recipe $recipe) => $recipe->toArray())->toArray(),
                    ]),
                ],
            ],
            'response_format' => [
                'type' => 'json_object',
            ],
        ]);

        return json_decode($response->choices[0]->message->content, true);
    }
}
