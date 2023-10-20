<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->group(function () {
    // Semua route yang ada di dalam sini harus login terlebih dahulu sebelum diakses

    Route::get('/posts', [PostController::class, 'index']);

    Route::get('/posts/{id}', [PostController::class, 'show']);

    Route::get('/logout', [AuthenticationController::class, 'logout']);

    Route::post('/posts', [PostController::class, 'store']);

    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('post.owner');

    Route::delete('/posts/{id}', [PostController::class, 'delete'])->middleware('post.owner');

    Route::post('/comment', [CommentController::class, 'store']);

    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('comment.owner');

    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('comment.owner');
});


// authentication
Route::post('/login', [AuthenticationController::class, 'login']);

Route::post('/register', [AuthenticationController::class, 'register']);
