<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blog-posts', BlogPostController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('blog-posts/{postId}/comments', [CommentController::class, 'store']);
});

Route::get('blog-posts/{postId}/comments', [CommentController::class, 'index']);

Route::get('/api/blog-posts/{id}', [BlogPostController::class, 'show']);
