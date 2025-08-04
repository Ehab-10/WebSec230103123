@extends('layouts.master')

@section('title', 'Edit Question')

@section('content')
<div class="container mt-5">
    <h2>Edit Question</h2>

    <form method="POST" action="{{ route('questions.update', $question) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question_text" class="form-label">Question</label>
            <textarea name="question_text" id="question_text" class="form-control" required>{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        @for ($i = 1; $i <= 4; $i++)
        <div class="mb-3">
            <label for="option{{ $i }}" class="form-label">Option {{ $i }}</label>
            <input type="text" name="option{{ $i }}" id="option{{ $i }}" class="form-control" required value="{{ old('option'.$i, $question->{'option'.$i}) }}">
        </div>
        @endfor

        <div class="mb-3">
            <label for="correct_option" class="form-label">Correct Option (1-4)</label>
            <input type="number" name="correct_option" id="correct_option" class="form-control" min="1" max="4" required value="{{ old('correct_option', $question->correct_option) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Question</button>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
