<?php

namespace App\Models;

use App\Models\Enums\MessageFrom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $guarded = [];

    protected $casts = [
        'from' => MessageFrom::class,
        'tool_calls' => 'array',
    ];

    public function chatSession(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class);
    }
}
