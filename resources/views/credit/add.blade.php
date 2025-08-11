@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add Credit to Customer</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('credit.add') }}" method="POST" class="mb-3">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Select Customer</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Choose Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }}) - Credit: ${{ number_format($customer->credit, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount to Add</label>
            <input type="number" name="amount" id="amount" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Credit</button>
    </form>
</div>
@endsection
