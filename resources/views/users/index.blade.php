@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">All Users</h2>

        @if(auth()->user()->admin)
            <a href="{{ route('users.create') }}" class="btn btn-success rounded-3">
                + Add New User
            </a>
        @endif
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary">Search</button>
        </div>
    </form>

    {{-- Users Table --}}
    <div class="card shadow rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Joined</th>
                        @if(auth()->user()->admin)
                            <th class="text-end">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->admin)
                                    <span class="badge bg-success">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            
                            @if(auth()->user()->admin)
                                <td class="text-end">
                                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm btn-info text-white">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->admin ? '6' : '5' }}" class="text-center py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
