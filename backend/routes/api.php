<?php

use App\Http\Controllers\ChatSessionApiController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MessageApiController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('chat-sessions', ChatSessionApiController::class)
    ->only('store');
Route::post('chat-sessions/{chatSession}/finalize', [ChatSessionApiController::class, 'finalize']);

Route::apiResource('chat-sessions.messages', MessageApiController::class)
    ->only('store');

Route::apiResource('recipes', RecipeController::class)
    ->only('index', 'show');
Route::apiResource('recipes.tags', TagController::class)
    ->only('index');
Route::apiResource('recipes.ingredients', IngredientController::class)
    ->only('index');
