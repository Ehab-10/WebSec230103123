@extends('layouts.master')

@section('content')
<div class="container py-5">
    <!-- Notifications -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Products</h1>
        @auth
            @if(auth()->user()->admin == 1 || auth()->user()->hasRole('employee'))
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Add Product
                </a>
            @endif
        @endauth
    </div>

    <!-- Search and Filter -->
    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="form-control" placeholder="Search products...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="sort_by" class="form-select">
                        <option value="">Sort By</option>
                        <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>
                            <i class="bi bi-currency-dollar me-1"></i> Price: Low to High
                        </option>
                        <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                            <i class="bi bi-currency-dollar me-1"></i> Price: High to Low
                        </option>
                        <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>
                            <i class="bi bi-sort-alpha-up me-1"></i> Name: A to Z
                        </option>
                        <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>
                            <i class="bi bi-sort-alpha-down me-1"></i> Name: Z to A
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-3">
                        <div class="card-body">
                            <div class="d-flex flex-column h-100">
                                <!-- Product Image -->
                                <div class="text-center mb-3">
                                    @if($product->photo)
                                        <img src="{{ asset($product->photo) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded-3" 
                                             style="max-height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light text-center p-4 rounded-3">
                                            <i class="bi bi-camera-fill text-muted" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Details -->
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                    <p class="card-text text-muted mb-3">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="h4 mb-0">
                                            <i class="bi bi-currency-dollar text-success"></i>
                                            <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                        </span>
                                        <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->stock }} in stock
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Actions -->
                                <div class="mt-auto">
                                    <div class="d-flex gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="btn btn-outline-primary flex-grow-1">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>

                                        <!-- Buy Button -->
                                        @auth
                                            @if($product->stock > 0)
                                                <form action="{{ route('products.buy', $product->id) }}" method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success flex-grow-1">
                                                        <i class="bi bi-cart-plus me-1"></i> Buy
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-outline-secondary flex-grow-1" disabled>
                                                    <i class="bi bi-cart-x me-1"></i> Out of Stock
                                                </button>
                                            @endif
                                        @endauth

                                        <!-- Edit Button -->
                                        @auth
                                            @if(auth()->user()->admin == 1 || auth()->user()->hasRole('employee'))
                                                <a href="{{ route('products.edit', $product->id) }}" 
                                                   class="btn btn-outline-warning flex-grow-1">
                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
            </div>
            <h3 class="mb-3">No Products Found</h3>
            <p class="text-muted">Try adjusting your search filters or come back later for more products.</p>
        </div>
    @endif
</div>
@endsection
