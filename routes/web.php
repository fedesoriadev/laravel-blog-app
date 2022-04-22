<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LanguageSelectorController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
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

Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show')
    ->middleware('can:view,post');

Route::get('authors/{author}', AuthorController::class)
    ->name('authors.show');

Route::get('tags/{tag}', TagController::class)
    ->name('tags.show');

Route::post('posts/{post}/comments', PostCommentsController::class)
    ->name('comments.store')
    ->middleware(['auth', 'verified']);

Route::get('profile', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->middleware(['auth', 'verified']);

Route::delete('profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy')
    ->middleware(['auth', 'verified', 'password.confirm']);

Route::get('lang/{locale}', LanguageSelectorController::class)
    ->name('lang');
