<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('communities', CommunityController::class);
Route::resource('communities.posts', CommunityPostController::class);
Route::resource('posts.comments', PostCommentsController::class);
Route::get('posts/{post}/vote/{vote}', [CommunityPostController::class, 'vote'])->name('posts.vote');
