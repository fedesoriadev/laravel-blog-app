<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class)
    ->except('show');

Route::middleware('can:admin')->group(function () {
    Route::get('/', IndexController::class)
        ->name('admin.home');

    Route::resource('users', UserController::class)
        ->except('show');

    Route::resource('comments', CommentController::class)
        ->only(['index', 'destroy']);
});
