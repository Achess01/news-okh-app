<?php

use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)->except(['index', 'show', 'create', 'store'])->middleware('auth');

Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth')->middleware('can:create post');
Route::get('me/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth')->middleware('can:create post');

Route::post('posts/{post}/report', [PostController::class, 'report'])->name('posts.report')->middleware('auth');

Route::get('me/posts', [PostController::class, 'my_posts'])->name('posts.my_posts')->middleware('auth')->middleware('can:create post');

Route::post('/attachments', [AttachmentsController::class, 'store'])->name('attachments.store')->middleware('auth');
