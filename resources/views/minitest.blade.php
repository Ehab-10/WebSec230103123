@extends('layouts.master')
@section('title', 'MiniTest - Supermarket Bill')

@section('content')

@php
  // Sample supermarket bill data
  $bill = [
      ['item' => 'Milk',   'price' => 2.5, 'qty' => 2],
      ['item' => 'Bread',  'price' => 1.8, 'qty' => 1],
      ['item' => 'Apple',  'price' => 0.5, 'qty' => 6],
  ];
  $grandTotal = 0;
@endphp

<div class="card shadow-lg border-0">
  <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">🧾 Supermarket Bill</h5>
    <span>{{ date('Y-m-d') }}</span>
  </div>

  <div class="card-body p-4">
    <div class="mb-4">
      <p><strong>Customer:</strong> Ahmed Ali</p>
      <p><strong>Invoice No:</strong> #INV-2025-001</p>
    </div>

    <table class="table table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>🛒 Item</th>
          <th>💵 Price ($)</th>
          <th>📦 Quantity</th>
          <th>🧮 Total ($)</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bill as $item)
          @php
            $total = $item['price'] * $item['qty'];
            $grandTotal += $total;
          @endphp
          <tr class="text-center">
            <td class="fw-bold text-start">{{ $item['item'] }}</td>
            <td>${{ number_format($item['price'], 2) }}</td>
            <td>{{ $item['qty'] }}</td>
            <td class="text-success fw-semibold">${{ number_format($total, 2) }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="table-light fw-bold text-end">
          <td colspan="3" class="pe-3 text-uppercase">Grand Total</td>
          <td class="text-primary fs-5">${{ number_format($grandTotal, 2) }}</td>
        </tr>
      </tfoot>
    </table>

    <p class="mt-4 text-muted">Thank you for shopping with us! 😊</p>
  </div>
</div>

@endsection
