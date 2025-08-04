<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{

public function show()
{
    $user = auth()->user();
    return view('users.profile', compact('user'));
}



    // صفحة تعديل الملف الشخصي
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // تحديث بيانات الملف الشخصي
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->fill($request->validated());

        // لو غير الإيميل نعيد تعيين التحقق
        if ($user->isDirty('email')) {
            $user->email_verified_at = $user->freshTimestamp();
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // حذف الحساب
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        throw ValidationException::withMessages([
            'current_password' => 'The current password is incorrect.',
        ]);
    }

    auth()->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('status', 'password-updated');
}
}
