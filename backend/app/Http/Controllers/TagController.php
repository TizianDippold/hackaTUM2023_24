<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagCollection;
use App\Models\Recipe;

class TagController extends Controller
{
    /**
     * Get all tags of a recipe from the database
     *
     * @apiResource App\Http\Resources\TagCollection
     *
     * @apiResourceModel App\Models\Tag
     */
    public function index(Recipe $recipe)
    {
        $tags = $recipe->tags;

        return new TagCollection($tags);
    }
}
