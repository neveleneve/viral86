<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('LandingPage');
});

Route::get('/news/{slug}', function ($slug) {
    return inertia('NewsDetail', ['slug' => $slug]);
});

Route::middleware('guest')->group(function () {
    Route::inertia('login', 'Auth/Login');
    Route::inertia('register', 'Auth/Register');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::inertia('dashboard', 'Authenticated/Dashboard/Index');
});
