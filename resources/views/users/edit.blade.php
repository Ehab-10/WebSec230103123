@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="container mt-5">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (optional):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <!-- ✅ Admin Checkbox -->
        <div class="form-check mb-3">
            <input type="checkbox" name="admin" class="form-check-input" id="adminCheck" {{ $user->admin ? 'checked' : '' }}>
            <label class="form-check-label" for="adminCheck">Is Admin?</label>
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
