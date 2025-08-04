<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ عرض المستخدمين مع إمكانية الفلترة
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    // ✅ عرض نموذج إضافة مستخدم
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // ✅ حفظ مستخدم جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'array'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        if ($request->has('roles')) {
            $user->roles()->attach($request->roles); // ربط الأدوار بالمستخدم
        }

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    // ✅ عرض نموذج تعديل مستخدم
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    // ✅ تعديل بيانات المستخدم
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'array'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->roles()->sync($request->roles); // تحديث الأدوار

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    // ✅ حذف مستخدم
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

    // ✅ عرض الملف الشخصي للمستخدم
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }
}
