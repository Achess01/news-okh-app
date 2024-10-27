<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostReportController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)->except(['index', 'show', 'create', 'store'])->middleware('auth');

Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth')->middleware('permission:create post');

Route::post('posts/{post}/report', [PostController::class, 'report'])->name('posts.report')->middleware('auth');

