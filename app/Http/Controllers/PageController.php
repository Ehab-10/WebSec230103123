<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showMessage()
    {
        $message = sayHello('From Controller');
        return view('message', ['message' => $message]);
    }
}
