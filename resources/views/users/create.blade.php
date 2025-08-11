@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-success text-white fs-4 text-center">
                    Create New User
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        {{-- Role Dropdown --}}
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user" selected>User</option>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        {{-- Submit --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
