@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Product Details</h1>

    <div class="card shadow">
        <div class="row g-0">
            <div class="col-md-4">
                @if($product->photo)
                    <img src="{{ $product->photo }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/300x300" class="img-fluid rounded-start" alt="No Image">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Model:</strong> {{ $product->model }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
