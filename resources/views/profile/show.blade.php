@extends('layouts.master')

@section('title', 'Profile Details')

@section('content')
<div class="container mt-5">
    <h2>Account Information</h2>

    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

    <p><strong>Email Verified:</strong>
        @if(auth()->user()->email_verified_at)
            {{ auth()->user()->email_verified_at->format('Y-m-d H:i') }}
        @else
            Not verified
        @endif
    </p>

    {{-- ✅ Display role based on the "admin" field --}}
    <p><strong>Role:</strong>
        @if(auth()->user()->admin == 1)
            Admin
        @elseif(auth()->user()->admin == 2)
            Employee
        @else
            Normal User
        @endif
    </p>
    

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
