@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Role</h1>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
