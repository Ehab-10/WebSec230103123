@extends('layouts.master')
@section('title', 'Multiplication Table')

@section('content')
<div class="card shadow col-md-5 mx-auto mt-4">
  <div class="card-header bg-primary text-white fw-bold">
    Enter a number to generate its multiplication table
  </div>
  <div class="card-body">
    <!-- Input Form -->
    <form method="GET" action="{{ url('/multable') }}">
      <div class="input-group mb-3">
        <input type="number" name="number" class="form-control" placeholder="Enter a number" required>
        <button type="submit" class="btn btn-success">Generate</button>
      </div>
    </form>

    <!-- Show table only if $j is set -->
    @if(!empty($j))
      <h5 class="text-center">Multiplication Table of {{ $j }}</h5>
      <table class="table table-bordered text-center mt-3">
        @foreach (range(1, 10) as $i)
          <tr>
            <td>{{ $i }}</td>
            <td>x</td>
            <td>{{ $j }}</td>
            <td>=</td>
            <td class="fw-bold text-success">{{ $i * $j }}</td>
          </tr>
        @endforeach
      </table>
    @endif
  </div>
</div>
@endsection
