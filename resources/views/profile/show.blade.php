@extends('layouts.master')

@section('title', 'Profile Details')

@section('content')
<div class="container mt-5">
    <h2>Account Information</h2>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Email Verified:</strong>
        @if($user->email_verified_at)
            {{ $user->email_verified_at->format('Y-m-d H:i') }}
        @else
            Not verified
        @endif
    </p>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
