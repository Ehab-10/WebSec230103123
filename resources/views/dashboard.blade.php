@extends('layouts.master') {{-- أو أي layout تستخدمه --}}

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h1 class="card-title mb-3">Welcome to your Dashboard, <strong>{{ Auth::user()->name }}</strong>!</h1>
            <p class="card-text fs-5">You are logged in.</p>
                <button class="btn btn-primary" onclick="alert('Hello from JavaScript!')">Say Hello</button>
        </div>
    </div>
</div>
@endsection
