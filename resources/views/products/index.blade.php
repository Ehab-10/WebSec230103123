@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Product List</h1>

    <!-- Search Form -->
    <!-- <form method="GET" action="{{ route('products.index') }}" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control w-25" placeholder="Search by name..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form> -->
    <!-- <form method="GET" action="{{ route('products.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
        @if(request()->has('search') && request('search') != '')
            <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Reset</a>
        @endif
    </div> -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="sort_by" class="form-select">
                <option value="">Sort By</option>
                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Search</button>
        </div>

        @if(request()->has('search') || request()->has('sort_by'))
        <div class="col-md-2">
            <a href="{{ route('products.index') }}" class="btn btn-outline-danger w-100">Reset</a>
        </div>
        @endif
    </div>
</form>

</form>


    @if ($products->count())
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->model }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            @if($product->photo)
                                <img src="{{ $product->photo }}" alt="Photo" width="70">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->withQueryString()->links() }}
    @else
        <div class="alert alert-info">No products found.</div>
    @endif
</div>
@endsection
