<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas de usuarios
Route::get('/index', [UserController::class, 'index'])->name('user.index'); 
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/user/{id}', [UserController::class, 'profile'])->name('user.profile');
Route::get('/profile/delete', [UserController::class, 'confirmDelete'])->name('user.confirmDelete');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

