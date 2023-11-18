<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatSession extends Model
{
    protected $guarded = [];

    protected $casts = [
        'filter' => AsArrayObject::class,
        'finalized' => 'boolean',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)
            ->orderBy('id', 'asc');
    }

    public function likedRecipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }
}
