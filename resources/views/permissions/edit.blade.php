@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Permission: <strong>{{ $permission->name }}</strong></h2>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <strong>There were some errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>🔴 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Permission Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $permission->name) }}" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Update</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">⬅ Back</a>
        </div>
    </form>
</div>
@endsection
