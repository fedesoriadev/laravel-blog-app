<?php

use App\Http\Controllers\Admin\ArchivePostController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PublishPostController;
use App\Http\Controllers\Admin\ResendVerificationEmailController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class)
    ->except('show');

Route::post('posts/{post}/publish', PublishPostController::class)
    ->name('posts.publish');

Route::post('posts/{post}/archive', ArchivePostController::class)
    ->name('posts.archive');


Route::middleware('can:admin')->group(function () {
    Route::get('/', AdminDashboardController::class)
        ->name('admin.home');

    Route::resource('users', UserController::class)
        ->except('show');

    Route::post('users/{user}/resend-verification', ResendVerificationEmailController::class)
        ->name('users.resend-verification');

    Route::resource('comments', CommentController::class)
        ->only(['index', 'destroy']);
});
