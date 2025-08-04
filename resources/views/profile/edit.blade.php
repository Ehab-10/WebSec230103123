@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Update Profile --}}
            <div class="card shadow mb-4 rounded-4">
                <div class="card-header bg-primary text-white fs-5">Update Profile</div>
                <div class="card-body">
                    @if(session('status') === 'profile-updated')
                        <div class="alert alert-success">Profile updated successfully.</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="card shadow mb-4 rounded-4">
                <div class="card-header bg-warning text-dark fs-5">Change Password</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                            @error('current_password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card shadow rounded-4 border-danger">
                <div class="card-header bg-danger text-white fs-5">Delete Account</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label class="form-label">Enter Password to Confirm</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
