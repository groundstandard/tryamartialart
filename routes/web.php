<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/articles', [PostController::class, 'articles'])->name('articles');
Route::get('/subscribe', [PostController::class, 'subscribe'])->name('subscribe');
Route::get('/p/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/category/{category}', [PostController::class, 'category'])->name('category');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
