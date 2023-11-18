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
        Schema::create('chat_session_recipe', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chat_session_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('recipe_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['chat_session_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_session_recipe');
    }
};
