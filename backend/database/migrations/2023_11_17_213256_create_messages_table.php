<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_session_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('from', ['user', 'system', 'assistant', 'tool']);
            $table->text('content')->nullable();

            // For tool == assistant
            $table->json('tool_calls')->nullable();

            // For from == tool
            $table->string('tool_call_id')->nullable();
            $table->string('function_name')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
