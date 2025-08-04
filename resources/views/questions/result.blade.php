@extends('layouts.master')

@section('title', 'Exam Result')

@section('content')
<div class="container mt-5">
    <h2>Exam Result</h2>

    <p>Score: {{ $score }} / {{ $total }}</p>
    <p>Percentage: {{ $percentage }}%</p>

    <a href="{{ route('questions.index') }}" class="btn btn-primary">Back to Questions</a>
</div>
@endsection
