<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // السماح فقط للذين لديهم صلاحية عرض المستخدمين بالدخول إلى index, show
        $this->middleware('permission:view_users')->only(['index', 'show']);

        // السماح فقط للأدمين بإنشاء المستخدمين الجدد
        $this->middleware('permission:create_users')->only(['create', 'store']);

        // السماح فقط لمن لديهم صلاحية تعديل المستخدمين بالتعديل
        $this->middleware('permission:edit_users')->only(['edit', 'update']);

        // السماح فقط للأدمين بحذف المستخدمين
        $this->middleware('permission:delete_users')->only('destroy');
    }

    public function index()
    {

        // dd(auth()->user()->getAllPermissions());

    //     // فقط الأدمين يشوف كل المستخدمين
        if (!auth()->user()->hasRole('admin|employee')) {
            abort(403, 'Unauthorized');
        }

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
       public function create()
    {
        return view('users.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        // هنا ممكن تعطي الدور بناءً على إدخالك أو تعيين تلقائي
        $user->assignRole('employee');

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        // المستخدم العادي يقدر يشوف ملفه فقط
        if (auth()->id() !== $user->id && !auth()->user()->can('view_users')) {
            abort(403);
        }

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $authUser = auth()->user();

        // الأدمين له كامل الصلاحيات
        if ($authUser->hasRole('admin')) {
            return view('users.edit', compact('user'));
        }

        // الموظف يقدر يعدل معلومات عامة فقط (مثلاً: الاسم والبريد)
        if ($authUser->hasRole('employee')) {
            return view('users.edit', compact('user'));
        }

        // المستخدم العادي يقدر يعدل ملفه فقط
        if ($authUser->id === $user->id) {
            return view('users.edit_self', compact('user'));
        }

        abort(403);
    }

    public function update(Request $request, User $user)
    {
        $authUser = auth()->user();

        if ($authUser->hasRole('admin')) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|confirmed|min:8',
                'admin' => 'nullable|boolean'
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            if (isset($data['admin']) && $data['admin']) {
                $user->syncRoles('admin');
            } else {
                $user->syncRoles('employee');
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated.');
        }

        if ($authUser->hasRole('employee')) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated by Employee.');
        }

        if ($authUser->id === $user->id) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|confirmed|min:8',
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profile updated.');
        }

        abort(403);
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete_users')) {
            abort(403);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }


    // عرض الملف الشخصي للمستخدم الحالي
public function profile()
{
    $user = auth()->user();
    return view('users.profile', compact('user'));
}

// تحديث الملف الشخصي للمستخدم الحالي
public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        // لا نسمح بتحديث الأدوار أو كلمة السر هنا (يمكن إضافة لاحقاً)
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully');

}

}
