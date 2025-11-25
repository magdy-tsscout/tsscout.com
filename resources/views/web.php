<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PricingController;

// Page Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pages', PagesController::class);
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('new-password', function () {
    return view('new-password');
});
Route::get('reset-password', function () {
    return view('reset-password');
});
Route::get('verify-email', function () {
    return view('verify-email');
});

// Blog Routes
Route::get('/blogs', [BlogController::class, 'userIndex'])->name('blogs.userIndex'); // Show all blogs
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');    // Show a single blog

// FAQ Routes
Route::get('faqs', [FaqController::class, 'userIndex'])->name('faqs');
Route::prefix('admin/faqs')->name('admin.faqs.')->group(function () {
    Route::get('index', [FaqController::class, 'adminIndex'])->name('index');
    Route::get('create', [FaqController::class, 'create'])->name('create');
    Route::post('', [FaqController::class, 'store'])->name('store');
    Route::get('{faq}/edit', [FaqController::class, 'edit'])->name('edit');
    Route::put('{faq}', [FaqController::class, 'update'])->name('update');
    Route::delete('{faq}', [FaqController::class, 'destroy'])->name('destroy');
});


Route::get('/{identifier}', [PagesController::class, 'show'])->name('page.show');
