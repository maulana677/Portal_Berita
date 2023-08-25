<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('login', [AdminAuthenticationController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthenticationController::class, 'handleLogin'])->name('handle-login');
    Route::post('logout', [AdminAuthenticationController::class, 'logout'])->name('logout');

    // forgot Password
    Route::get('forgot-password', [AdminAuthenticationController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AdminAuthenticationController::class, 'sendResetLink'])->name('forgot-password.send');

    // reset password
    Route::get('reset-password/{token}', [AdminAuthenticationController::class, 'resetPassword'])->name('reset-password');
    Route::post('reset-password', [AdminAuthenticationController::class, 'handleresetPassword'])->name('reset-password.send');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // profile routes
    Route::put('profile-password-update/{id}', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');
    Route::resource('profile', ProfileController::class);

    // route bahasa
    Route::resource('bahasa', LanguageController::class);

    // route kategori
    Route::resource('kategori', CategoryController::class);

    // route Berita
    Route::get('fetch-berita-category', [NewsController::class, 'fetchCategory'])->name('fetch-berita-category');
    Route::resource('berita', NewsController::class);
});
