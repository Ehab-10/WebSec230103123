<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // التحقق من وجود المستخدم أو إنشاؤه
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('google_dummy_password'), // مطلوب إذا لم يكن nullable
                ]
            );

            // تسجيل الدخول
            Auth::login($user);

            return redirect('/dashboard'); // أو أي صفحة تريد
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'حدث خطأ أثناء تسجيل الدخول باستخدام Google.');
        }
    }
}
