<?php

namespace App\Models\Enums;

enum MessageFrom: string
{
    case User = 'user';
    case System = 'system';
    case Tool = 'tool';
    case Assistant = 'assistant';
}
