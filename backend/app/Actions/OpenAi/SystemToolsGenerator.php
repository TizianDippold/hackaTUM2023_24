<?php

namespace App\Actions\OpenAi;

use App\Models\Ingredient;

class SystemToolsGenerator
{
    public function generate(): array
    {
        return [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'filter',
                    'description' => 'Will be called to filter the recipe selection of the user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'vegan' => [
                                'type' => 'boolean',
                                'description' => 'true if the recipe should be vegan.',
                            ],

                            'vegetarian' => [
                                'type' => 'number',
                                'description' => 'true if the recipe should be vegetarian.',
                            ],

                            'sustainable' => [
                                'type' => 'boolean',
                                'description' => 'true if the recipe should be sustainable.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'without_ingredients',
                    'description' => 'Will be called to mark ingredients that should not be in the recipe under any circumstances. You can pass multiple ingredients as a parameter.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'ingredients' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'string',
                                    'enum' => Ingredient::get()
                                        ->map(fn (Ingredient $ingredient) => $ingredient->name)
                                        ->toArray(),
                                    'description' => 'The ingredients that should not be in the recipe. You can pass multiple ingredients as a parameter.',
                                ],
                            ],
                        ],
                        'required' => [
                            'ingredients',
                        ],
                    ],
                ],
            ],
        ];
    }
}
