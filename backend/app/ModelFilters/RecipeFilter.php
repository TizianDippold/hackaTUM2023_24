<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

const SUSTAINABLE_RECIPE_RATING = 0.85;

class RecipeFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function vegan($value)
    {
        if ($value === 'true' || $value === true) {
            return $this->whereDoesntHave('ingredients', function ($query) {
                $query->where('is_vegan', false);
            });
        } elseif ($value === 'false' || $value === false) {
            return $this->whereHas('ingredients', function ($query) {
                $query->where('is_vegan', false);
            });
        }

        return $this;
    }

    public function vegetarian($value)
    {
        if ($value === 'true' || $value === true) {
            return $this->whereDoesntHave('ingredients', function ($query) {
                $query->where('is_vegetarian', false);
            });
        } elseif ($value === 'false' || $value === false) {
            return $this->whereHas('ingredients', function ($query) {
                $query->where('is_vegetarian', false);
            });
        }

        return $this;
    }

    public function sustainable($value)
    {
        if ($value) {
            return $this->where('sustainability_rating', '>=', SUSTAINABLE_RECIPE_RATING);
        }

        return $this;
    }

    public function withoutIngredient($value)
    {
        if (is_array($value)) {
            return $this->whereDoesntHave('ingredients', function ($query) use ($value) {
                $query->whereIn('name', $value);
            });
        } else {
            return $this->whereDoesntHave('ingredients', function ($query) use ($value) {
                $query->where('name', $value);
            });
        }
    }
}
