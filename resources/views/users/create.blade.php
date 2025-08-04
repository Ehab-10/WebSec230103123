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

                        {{-- Admin Checkbox --}}
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1">
                            <label class="form-check-label" for="admin">Make this user an Admin</label>
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
