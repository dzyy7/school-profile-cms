<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/settings', function () {
    return view('admin.settings.index');
})->middleware(['auth', 'verified'])->name('settings');


Route::get('/messages', function () {
    return view('admin.messages.index');
})->middleware(['auth', 'verified'])->name('messages');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'] )->name('dashboard');

    //posts routes
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/posts/upload-image', [PostController::class, 'uploadBodyImage'])->name('posts.upload_image');

    //teachers routes
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::delete('/teachers/{teacher:id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::get('/teachers/{teacher:id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher:id}', [TeacherController::class, 'update'])->name('teachers.update');

    //Banners routes
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::delete('/banners/{banner:id}', [BannerController::class, 'destroy'])->name('banners.destroy');
    Route::get('/banners/{banner:id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{banner:id}', [BannerController::class, 'update'])->name('banners.update');

    Route::patch('/banners/{id}/toggle', [BannerController::class, 'toggleActive'])->name('banners.toggle');
    Route::patch('/banners/{id}/up', [BannerController::class, 'moveUp'])->name('banners.up');
    Route::patch('/banners/{id}/down', [BannerController::class, 'moveDown'])->name('banners.down');

    //Settings routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
