<?php

use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)->except(['index', 'create', 'store'])->middleware('auth');
Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth')->middleware('can:create post');
Route::get('me/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth')->middleware('can:create post');
Route::post('posts/{post}/report', [PostController::class, 'report'])->name('posts.report')->middleware('auth');
Route::get('me/posts', [PostController::class, 'my_posts'])->name('posts.my_posts')->middleware('auth')->middleware('can:create post');
Route::get('reported-posts', [PostController::class, 'reported'])->name('posts.reported_posts')->middleware('auth')->middleware('role:admin');
Route::post('accept_reported/{post}', [PostController::class, 'accept_reports'])->name('posts.accept_reports')->middleware('auth')->middleware('role:admin');
Route::post('ignore_reports/{post}', [PostController::class, 'ignore_reports'])->name('posts.ignore_reports')->middleware('auth')->middleware('role:admin');
Route::get('reported-posts/{post}', [PostController::class, 'show_reported'])->name('posts.show_reported')->middleware('auth')->middleware('role:admin');
Route::get('review-posts', [PostController::class, 'review'])->name('posts.review')->middleware('auth')->middleware('role:admin');
Route::get('review-posts/{post}', [PostController::class, 'show_review'])->name('posts.show_review')->middleware('auth')->middleware('role:admin');
Route::post('accept_post/{post}', [PostController::class, 'accept_post'])->name('posts.accept_post')->middleware('auth')->middleware('role:admin');
Route::post('reject_post/{post}', [PostController::class, 'reject_post'])->name('posts.reject_post')->middleware('auth')->middleware('role:admin');

Route::post('me/subscribe/{post}', [PostController::class, 'subscribe_user'])->name('posts.subscribe_user')->middleware('auth');
Route::post('me/unsubscribe/{post}', [PostController::class, 'unsubscribe_user'])->name('posts.unsubscribe_user')->middleware('auth');

Route::get('me/notifications', [NotificationsController::class, 'index'])->name('notifications.index')->middleware('auth');


Route::post('/attachments', [AttachmentsController::class, 'store'])->name('attachments.store')->middleware('auth');

use App\Http\Controllers\ReportController;

Route::prefix('reports')->group(function () {
    Route::get('post-status', [ReportController::class, 'postStatusReport'])->name('reports.postStatus');
    Route::get('post-reports', [ReportController::class, 'postReportsReport'])->name('reports.postReports');
})->middleware('auth')->middleware('role:admin');

