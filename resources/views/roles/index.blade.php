@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Roles List</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-success">➕ Add New Role</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $perm)
                                <span class="badge bg-primary">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning me-1">✏️ Edit</a>

                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">
                                    🗑 Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No roles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
