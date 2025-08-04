@extends('layouts.master')

@section('content')
<div class="container">
    <h2>➕ Add New Product</h2>

    @if ($errors->any())
        <div>
            <strong>⚠️ Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>🔴 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label>Product Name:</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label>Price:</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01">
        </div>

        <button type="submit">✅ Save</button>
        <a href="{{ route('products.index') }}">⬅ Back</a>
    </form>
</div>
@endsection
