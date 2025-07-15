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

