<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
// الصفحة الرئيسية
Route::get('/', function () {
    return redirect('/dashboard');
});

// Laravel Breeze routes
require __DIR__.'/auth.php';

// ----------------- مسارات محمية -----------------
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Profile
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Products, Grades, Questions
 Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);

    Route::resource('grades', GradeController::class);
    Route::resource('questions', QuestionController::class);
    Route::post('/questions/submit', [QuestionController::class, 'submit'])->name('questions.submit');
});

// ----------------- مسارات للـ Admin فقط -----------------
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('users', UserController::class);

});

// ----------------- صفحات عامة (بدون تسجيل دخول) -----------------
Route::get('/even', fn () => view('even'))->name('even');
Route::get('/prime', fn () => view('prime'))->name('prime');
Route::get('/multable', fn () => view('multable'))->name('multable');
Route::get('/calculator', fn () => view('calculator'))->name('calculator');
Route::get('/minitest', fn () => view('minitest'))->name('minitest');

// ----------------- GPA Page -----------------
Route::get('/gpa', function () {
    $courses = [];
    return view('gpa', compact('courses'));
})->middleware('auth')->name('gpa');

// ----------------- Register override -----------------
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/users', [UserController::class, 'index'])->middleware('role:admin');

Route::get('/users', [UserController::class, 'index'])->name('users.index');


// routes/web.php


// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');


use App\Http\Controllers\SocialController;

Route::get('/login/{provider}', [SocialController::class, 'redirect']);
Route::get('/login/{provider}/callback', [SocialController::class, 'callback']);


Route::get('/admin', function () {
    return 'Welcome, Admin!';
})->middleware('role:admin');

Route::get('/edit-post', function () {
    return 'Edit Page';
})->middleware('permission:edit posts');



Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


Route::get('/login/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
