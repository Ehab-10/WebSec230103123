@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Permissions List</h2>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">➕ Add New Permission</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Permission Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning me-2">✏️ Edit</a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this permission?')" class="btn btn-sm btn-danger">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
