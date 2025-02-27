<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);

// Autenticación de usuarios
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'loginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Gestión de posts
Route::get('/post/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/post', [PostController::class, 'store'])->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'show']);
Route::delete('/post/{post}', [PostController::class, 'destroy'])->middleware('auth');

// Comentarios
Route::post('/post/{post}/comment', [CommentController::class, 'store'])->middleware('auth');
