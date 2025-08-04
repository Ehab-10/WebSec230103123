@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Add New Role</h2>

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

    <form action="{{ route('roles.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Role Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Permissions:</label>
            <div class="form-check">
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input 
                            type="checkbox" 
                            name="permissions[]" 
                            value="{{ $permission->id }}" 
                            id="permission_{{ $permission->id }}"
                            class="form-check-input">
                        <label for="permission_{{ $permission->id }}" class="form-check-label">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">✅ Save</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">⬅ Back</a>
        </div>
    </form>
</div>
@endsection
