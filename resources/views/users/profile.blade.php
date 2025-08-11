@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" 
                                       name="password_confirmation">
                            </div>
                        </div>

                        @if(auth()->user()->role === 'user')
                        <div class="bg-light p-3 rounded mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-wallet me-2 fs-4"></i>
                                    <span class="fw-medium">Your Credit:</span>
                                </div>
                                <span class="badge bg-primary px-3 py-2">${{ number_format(auth()->user()->credit, 2) }}</span>
                            </div>
                        </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('purchases.my') }}" class="btn btn-outline-primary me-md-2">My Purchases</a>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
