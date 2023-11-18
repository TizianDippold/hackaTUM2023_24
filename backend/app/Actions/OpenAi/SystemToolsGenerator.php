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

                            'fast_preptime' => [
                                'type' => 'boolean',
                                'description' => 'true if the recipe should be fast or short to prepare.',
                            ],

                            'low_sugar' => [
                                'type' => 'boolean',
                                'description' => 'true if the recipe should be low in sugar.',
                            ],

                            'high_protein' => [
                                'type' => 'boolean',
                                'description' => 'true if the recipe should be high in protein.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'without_ingredients',
                    'description' => 'Will be called to mark ingredients that should not be in the recipe under any circumstances. You can pass multiple ingredients as a parameter and should do so if necessary.',
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
            [
                'type' => 'function',
                'function' => [
                    'name' => 'finish',
                    'description' => 'Will be called to finish the recipe selection of the user.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => json_decode('{}'),
                    ],
                ],
            ],
        ];
    }
}
