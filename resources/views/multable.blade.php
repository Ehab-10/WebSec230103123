@extends('layouts.master')
@section('title', 'Multiplication Table')

@section('content')
<div class="card shadow col-md-5 mx-auto">
  <div class="card-header bg-info text-white fw-bold">
    Multiplication Table of {{ $j }}
  </div>
  <div class="card-body">
    <table class="table table-bordered text-center">
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
  </div>
</div>
@endsection
