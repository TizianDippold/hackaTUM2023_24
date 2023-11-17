<?php

namespace App\Models;

use App\Models\Enums\MessageFrom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'from',
        'content',
    ];

    protected $casts = [
        'from' => MessageFrom::class,
    ];

    public function chatSession(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class);
    }
}
