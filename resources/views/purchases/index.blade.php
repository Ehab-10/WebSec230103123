@extends('layouts.master')

@section('content')
<div class="container">
    <h1>My Purchases</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($purchases->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Purchased On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->pivot->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}

    @else
        <p>You have no purchases yet.</p>
    @endif
</div>
@endsection
