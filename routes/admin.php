<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridThreeController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SocialCountController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
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
    Route::get('toggle-berita-status', [NewsController::class, 'toggleBeritaStatus'])->name('toggle-berita-status');
    Route::get('berita-copy/{id}', [NewsController::class, 'copyNews'])->name('berita-copy');
    Route::resource('berita', NewsController::class);

    // route pengaturan
    Route::get('home-section-setting', [HomeSectionSettingController::class, 'index'])->name('home-section-setting.index');
    Route::put('home-section-setting', [HomeSectionSettingController::class, 'update'])->name('home-section-setting.update');

    // route pengaturan media sosial
    Route::resource('social-count', SocialCountController::class);

    // route iklan
    Route::resource('ad', AdController::class);

    // route pegikut(subscibers)
    Route::resource('subscribers', SubscriberController::class);

    // route social links
    Route::resource('social-link', SocialLinkController::class);

    // route Footer Info
    Route::resource('footer-info', FooterInfoController::class);

    // route Footer Grid One
    Route::resource('footer-grid-one', FooterGridOneController::class);

    // route Footer Grid Two
    Route::resource('footer-grid-two', FooterGridTwoController::class);

    // route Footer Grid Three
    Route::resource('footer-grid-three', FooterGridThreeController::class);
});
