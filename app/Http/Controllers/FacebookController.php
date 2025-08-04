<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        // Your logic to login/register user goes here

        return redirect('/home');
    }
}
