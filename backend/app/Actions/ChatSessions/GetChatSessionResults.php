<?php

namespace App\Actions\ChatSessions;

use App\Models\ChatSession;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use OpenAI\Laravel\Facades\OpenAI;

const OPENAI_RANKING_MODEL = 'gpt-4-1106-preview';
const RANKING_SYSTEM_PROMPT = 'You are an assistant that helps the user to choose an optimal recipe. You get the filter options that the user chose and the available recipes as an input in json format. Rank the recipes according to the filter options of the user. Respond with nothing else but the following json format: {"place_1": RECIPE, "place_2": RECIPE, ...}. Replace RECIPE with the id of the the recipe that has the n-th place in the ranking.';

class GetChatSessionResults
{
    /**
     * @return array|ChatSession[]
     */
    public function getResults(ChatSession $chatSession): array
    {
        $filter = $chatSession->filter->toArray();
        $recipes = Recipe::filter($filter)
            ->with('tags', 'ingredients')
            ->get();

        $openAiRanking = $this->getOpenAiRanking($recipes, $filter);

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
    private function getOpenAiRanking(Collection $recipes, array $filter): array
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
