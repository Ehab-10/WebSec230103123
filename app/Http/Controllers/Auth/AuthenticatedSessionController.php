<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('The provided credentials are incorrect.'),
            ]);
        }

        Auth::login($user, $request->boolean('remember'));

        // Check if this password was a temporary one (based on your logic)
        // You can add a flag column (like `is_temp_password`) to your users table for better detection
        if (Session::has('temp_password') && Hash::check(Session::get('temp_password'), $user->password)) {
            Session::put('force_password_change', true);
            Session::forget('temp_password');
        }

        if (Session::has('force_password_change')) {
            return redirect()->route('password.change');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
