<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
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

//Route::middleware('auth.system')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('tags', TagController::class);
//});
