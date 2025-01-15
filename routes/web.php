<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;


Route::get('/', [PostController::class, 'showPosts'])->name('home');

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class);

Route::post('/comments', [PostController::class, 'storeComment'])->name('comments.store');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
