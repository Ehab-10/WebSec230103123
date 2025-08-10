@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add New Permission</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Permission Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter permission name" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
