@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2>User Details</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Role:</strong> {{ $user->roles->pluck('name')->join(', ') }}</li>
        <li class="list-group-item"><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</li>
    </ul>

    <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back to Users List</a>
</div>
@endsection
