@extends('layouts.master')
@section('title', 'Prime Numbers')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-warning text-dark fw-bold">
    Prime Numbers (1 to 100)
  </div>
  <div class="card-body row">
    @foreach (range(1, 100) as $i)
      @if(isPrime($i))
        <div class="col-1 m-1 text-center">
          <span class="badge bg-danger">{{ $i }}</span>
        </div>
      @endif
    @endforeach
  </div>
</div>
@endsection
