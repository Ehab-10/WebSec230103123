<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'تم إنشاء الصلاحية بنجاح.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'تم تحديث الصلاحية.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'تم حذف الصلاحية.');
    }
}

