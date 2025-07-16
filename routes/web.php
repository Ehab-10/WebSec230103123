<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/hello', function () {
    return sayHello('Ehab');
});

use App\Http\Controllers\PageController;

Route::get('/message', [PageController::class, 'showMessage']);

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function () {
    return view('prime');
});

Route::get('/multable/{number?}', function ($number = 2) {
    $j = $number;
    return view('multable', compact('j'));
});
