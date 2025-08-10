@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2>My Profile</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Password (leave blank to keep current):</label>
            <input type="password" name="password" class="form-control">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        @if(auth()->user()->role === 'user')
    <div class="alert alert-success d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-wallet me-2 fs-4"></i>
            <span class="fw-medium">Your Credit:</span>
        </div>
        <span class="badge bg-dark fs-5 px-3 py-2">${{ number_format(auth()->user()->credit, 2) }}</span>
    </div>
@endif

        <button class="btn btn-primary w-100">Update Profile</button>
    </form>
</div>
@endsection
