<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\SocialController;

// الصفحة الرئيسية
Route::get('/', fn() => redirect('/dashboard'));

// Laravel Breeze routes
require __DIR__.'/auth.php';

// ----------------- مسارات محمية -----------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // ملف المستخدم العادي والموظف: عرض وتعديل المعلومات العامة فقط
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // باقي الموارد العامة
    Route::resource('products', ProductController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('questions', QuestionController::class);
    Route::post('/questions/submit', [QuestionController::class, 'submit'])->name('questions.submit');

    // GPA Simulator
    Route::get('/gpa', function () {
        $courses = [];
        return view('gpa', compact('courses'));
    })->name('gpa');
});

// ----------------- مسارات إدارة المستخدمين والأدوار والصلاحيات (للمسؤول فقط) -----------------
Route::middleware(['auth', 'role:admin'])->group(function () {

    // CRUD للمستخدمين مع صلاحيات كاملة (Admin فقط)
 

    // CRUD للأدوار
    Route::resource('roles', RoleController::class);

    // CRUD للصلاحيات
    Route::resource('permissions', PermissionController::class);

});

// Route::middleware(['role:admin|employee'])->group(function () {
//     // مسارات يسمح بها للأدمن والموظف
//     Route::resource('users', UserController::class);
// });

Route::middleware(['auth', 'permission:edit_users'])->group(function () {
    Route::resource('users', UserController::class);
});



// ----------------- صفحات عامة (بدون تسجيل دخول) -----------------
Route::view('/even', 'even')->name('even');
Route::view('/prime', 'prime')->name('prime');
Route::view('/multable', 'multable')->name('multable');
Route::view('/calculator', 'calculator')->name('calculator');
Route::view('/minitest', 'minitest')->name('minitest');

// ----------------- تسجيل حساب جديد -----------------
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// ----------------- إعادة تعيين كلمة المرور -----------------
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

// ----------------- تسجيل الدخول عبر الشبكات الاجتماعية -----------------
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/login/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('/login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/callback/{provider}', [SocialController::class, 'callback'])->name('social.callback');

// ----------------- أمثلة على حماية المسارات باستخدام الأدوار والصلاحيات -----------------
Route::get('/admin', fn () => 'Welcome, Admin!')->middleware('role:admin');
Route::get('/edit-post', fn () => 'Edit Page')->middleware('permission:edit posts');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');


