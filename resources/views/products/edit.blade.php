@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit Product: <span class="text-primary">{{ $product->name }}</span></h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>🔴 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price:</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
    <label class="form-label">Image URL:</label>
    <input type="url" name="image_url" value="{{ old('image_url', $product->image_url) }}" class="form-control">
</div>

@if ($product->image_url)
    <div class="mb-3 text-center">
        <label class="form-label d-block">Current Image:</label>
        <img src="{{ $product->image_url }}" alt="Product Image" class="img-fluid" style="max-height: 200px;">
    </div>
@endif


        <div class="d-flex justify-content-between">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">⬅ Back</a>
            <button type="submit" class="btn btn-primary">💾 Update Product</button>
        </div>
    </form>
</div>
@endsection
