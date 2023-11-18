<?php

namespace App\Actions\OpenAi;

use App\Models\Enums\MessageFrom;
use App\Models\Message;

class OpenAiMessageTransformer
{
    public function fromDatabase(Message $dbMessage): array
    {
        $data = [
            'role' => match ($dbMessage->from) {
                MessageFrom::System => OPENAI_ROLE_SYSTEM,
                MessageFrom::User => OPENAI_ROLE_USER,
                MessageFrom::Tool => OPENAI_ROLE_TOOL,
                MessageFrom::Assistant => OPENAI_ROLE_ASSISTANT,
            },
            'content' => $dbMessage->content,
        ];

        if ($dbMessage->from === MessageFrom::Tool) {
            $data['tool_call_id'] = $dbMessage->tool_call_id;
            $data['name'] = $dbMessage->function_name;
        }

        if ($dbMessage->from === MessageFrom::Assistant && $dbMessage->tool_calls !== null) {
            $data['tool_calls'] = $dbMessage->tool_calls;
        }

        return $data;
    }

    public function toDatabase(array $openAiMessage): array
    {
        return [
            'from' => match ($openAiMessage['role']) {
                OPENAI_ROLE_SYSTEM => MessageFrom::System,
                OPENAI_ROLE_USER => MessageFrom::User,
                OPENAI_ROLE_TOOL => MessageFrom::Tool,
                OPENAI_ROLE_ASSISTANT => MessageFrom::Assistant,
            },
            'content' => $openAiMessage['content'],
            'tool_calls' => array_key_exists('tool_calls', $openAiMessage) && $openAiMessage['tool_calls'] !== null
                ? json_decode(json_encode($openAiMessage['tool_calls']), true)
                : null,
            'tool_call_id' => $openAiMessage['tool_call_id'] ?? null,
            'function_name' => $openAiMessage['name'] ?? null,
        ];
    }
}
