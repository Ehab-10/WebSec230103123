<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class RoleController extends Controller
{
 public function __construct()
{
    $this->middleware(function ($request, $next) {
        if (!Auth::check() || !Auth::user()->admin) {
            abort(403, 'غير مسموح.');
        }
        return $next($request);
    });
}


    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array|nullable'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'تم إنشاء الدور بنجاح.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array|nullable'
        ]);

        $role->update(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'تم تحديث الدور بنجاح.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'تم حذف الدور.');
    }
}
