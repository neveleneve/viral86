<?php

use App\Http\Controllers\ActiveAdsController;
use App\Http\Controllers\AdsRequestController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'landingPage']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::inertia('register', 'Auth/Register');
});

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::inertia('dashboard', 'Authenticated/Dashboard/Index')->name('dashboard.index');

        Route::resource('konten', ContentController::class)->except('edit');
        Route::resource('media', MediaController::class)->except('edit', 'show', 'update');
        Route::resource('kategori', CategoryController::class)->except('edit');
        Route::resource('tag', TagController::class)->except('edit');

        Route::resource('iklan-aktif', ActiveAdsController::class);
        Route::resource('permintaan-iklan', AdsRequestController::class);

        Route::resource('redaksi', EditorialController::class);
        Route::resource('pembaca', ReaderController::class);
        Route::resource('pengiklan', AdvertiserController::class);

        Route::get('pengaturan', [SettingController::class, 'index'])->name('pengaturan.index');
        Route::post('pengaturan/change-profile', [SettingController::class, 'changeProfile'])->name('pengaturan.change-profile');
        Route::post('pengaturan/change-password', [SettingController::class, 'changePassword'])->name('pengeturan.change-password');
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

Route::get('category/{category}', [NewsController::class, 'categoryPost']);

Route::get('tag/{tag}', [NewsController::class, 'tagPost']);

Route::get('author/{username}', [NewsController::class, 'authorsPost']);

Route::get('news/{category}/{slug}', [NewsController::class, 'newsDetail']);
