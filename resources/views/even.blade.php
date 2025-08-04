@extends('layouts.master')
@section('title', 'Even Numbers')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">
    Even Numbers (1 to 100)
  </div>
  <div class="card-body row">
    @foreach (range(1, 100) as $i)
      @if($i % 2 == 0)
        <div class="col-1 m-1 text-center">
          <span class="badge bg-success">{{ $i }}</span>
        </div>
      @endif
    @endforeach
  </div>
</div>
@endsection
