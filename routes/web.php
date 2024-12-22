<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'index']);
// Route::get('/', function() {
//     return view('posts.index');
// });
Route::get('/posts', function() {
    return view('posts.show');
});
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');