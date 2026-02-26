<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('LandingPage');
});

Route::get('news/{slug}', function ($slug) {
    return inertia('NewsDetail', ['slug' => $slug]);
});

Route::get('terkini', function () {
    return inertia('LatestNews');
});

Route::get('daerah', function () {
    return inertia('RegionalNews');
});

Route::get('nasional', function () {
    return inertia('NationalNews');
});

Route::get('redaksi', function () {
    return inertia('RedaksiPage');
});

Route::middleware('guest')->group(function () {
    Route::inertia('login', 'Auth/Login')->name('login');
    Route::inertia('register', 'Auth/Register');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::inertia('dashboard', 'Authenticated/Dashboard/Index');
});
