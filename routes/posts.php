<?php 

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'showCreate'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('post.like');
    Route::post('/posts/{id}/comment', [PostController::class, 'addComment'])->name('post.create_comment');    
});