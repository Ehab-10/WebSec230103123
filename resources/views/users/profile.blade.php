@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4">
                    My Profile
                </div>
                <div class="card-body">
                    <p class="mb-3"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="mb-3"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-0"><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                </div>

                @if(auth()->id() === $user->id)
                <div class="card-footer text-end">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary">
                        Edit Profile
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
