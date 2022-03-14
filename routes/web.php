<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])
    ->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])
    ->name('posts.show')
    ->middleware(['can:view,post']);

Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware(['auth']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware(['auth']);

Route::get('/tags/{tag:slug}', [TagController::class, 'show'])
    ->name('tags.show');

Route::get('/@{user:username}', [UserController::class, 'show'])
    ->name('authors.show');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware(['auth']);

Route::patch('/users/{user:username}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware(['auth']);

Route::delete('/users/{user:username}', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware(['auth']);


Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::resource('posts', AdminPostController::class)
            ->except(['index', 'show']);
    });
