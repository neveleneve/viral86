<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('LandingPage');
});

Route::get('{category}/{slug}', function ($category, $slug) {
    return inertia('NewsDetail', [
        'category' => $category,
        'slug' => $slug,
    ]);
});

Route::get('terkini', function () {
    return inertia('LatestNews');
});

Route::get('redaksi', function () {
    return inertia('RedaksiPage');
});

Route::get('category/{category}', function ($category) {
    return inertia('CategoryNews', ['category' => $category]);
});

Route::get('tag/{tag}', function ($tag) {
    return inertia('TagNews', ['tag' => $tag]);
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::inertia('register', 'Auth/Register');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::inertia('dashboard', 'Authenticated/Dashboard/Index');
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
});
