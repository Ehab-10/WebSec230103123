@extends('layouts.master')
@section('title', 'Prime Numbers')
@section('content')
    <div class="card">
        <div class="card-header">
            Prime Numbers
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach (range(1, 100) as $i)
                    @if(isPrime($i))
                        <span class="btn btn-primary">{{ $i }}</span>
                    @else
                        <span class="btn btn-secondary">{{ $i }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
