<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeCollection;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Get all recipes from the database
     *
     * @apiResource App\Http\Resources\RecipeCollection
     *
     * @apiResourceModel App\Models\Recipe
     */
    public function index()
    {
        $recipes = Recipe::all();

        return new RecipeCollection($recipes);
    }

    /**
     * Get a single recipe from the database
     *
     * @apiResource App\Http\Resources\RecipeResource
     *
     * @apiResourceModel App\Models\Recipe
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }
}
