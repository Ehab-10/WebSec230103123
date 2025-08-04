@extends('layouts.master')

@section('title', 'Start Exam')

@section('content')
<div class="container mt-5">
    <h2>Start Exam</h2>
    <form action="{{ route('exam.submit') }}" method="POST">
        @csrf
        @foreach($questions as $q)
        <div class="mb-4 p-3 border rounded">
            <p><strong>Q{{ $loop->iteration }}: </strong> {{ $q->question_text }}</p>
            @for($i=1; $i<=4; $i++)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q{{ $q->id }}opt{{ $i }}" value="{{ $i }}" required>
                <label class="form-check-label" for="q{{ $q->id }}opt{{ $i }}">
                    {{ $q->{'option'.$i} }}
                </label>
            </div>
            @endfor
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>
</div>
@endsection
