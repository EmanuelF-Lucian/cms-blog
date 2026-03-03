<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
  Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

  Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
});




Route::get('dashboard', fn() => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
