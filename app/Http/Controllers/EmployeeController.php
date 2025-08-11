<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // ✅ Add this
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Create the employee user
        $employee = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign Employee role
        $employee->assignRole('employee');

        return redirect()->route('employees.create')->with('success', 'Employee account created successfully.');
    }
}
