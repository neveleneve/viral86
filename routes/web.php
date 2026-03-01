<?php

use App\Http\Controllers\ActiveAdsController;
use App\Http\Controllers\AdsRequestController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('LandingPage');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::inertia('register', 'Auth/Register');
});

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::resource('tag', TagController::class);
        Route::resource('kategori', CategoryController::class);

        Route::inertia('dashboard', 'Authenticated/Dashboard/Index');

        Route::resource('konten', ContentController::class);
        Route::resource('media', MediaController::class);

        Route::resource('iklan-aktif', ActiveAdsController::class);
        Route::resource('permintaan-iklan', AdsRequestController::class);

        Route::resource('redaksi', EditorialController::class);
        Route::resource('pembaca', ReaderController::class);
        Route::resource('pengiklan', AdvertiserController::class);

        Route::inertia('pengaturan', 'Authenticated/Settings/Index');
    });

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
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

Route::get('{category}/{slug}', function ($category, $slug) {
    return inertia('NewsDetail', [
        'category' => $category,
        'slug' => $slug,
    ]);
});
