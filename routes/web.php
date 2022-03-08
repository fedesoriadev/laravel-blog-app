<?php

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
Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store')
    ->middleware(['can:create,App\Models\Post']);
Route::patch('/posts/{post:slug}', [PostController::class, 'update'])
    ->name('posts.update')
    ->middleware(['can:update,post']);
Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware(['can:delete,post']);

Route::get('/tags/{tag:slug}', [TagController::class, 'show'])
    ->name('tags.show');

Route::get('/@{user:username}', [UserController::class, 'show'])
    ->name('authors.show');
