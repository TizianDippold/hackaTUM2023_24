<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientCollection;
use App\Models\Recipe;

class IngredientController extends Controller
{
    /**
     *Get all ingredients of a recipe from the database
     *
     * @apiResource App\Http\Resources\IngredientCollection
     *
     * @apiResourceModel App\Models\Ingredient
     */
    public function index(Recipe $recipe)
    {
        $ingredients = $recipe->ingredients;

        return new IngredientCollection($ingredients);
    }
}
