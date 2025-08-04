@extends('layouts.master')

@section('title', 'Edit Grade')

@section('content')
<div class="container mt-5">
    <h2>Edit Grade</h2>

    <form method="POST" action="{{ route('grades.update', $grade) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" value="{{ old('subject', $grade->subject) }}" class="form-control @error('subject') is-invalid @enderror" required>
            @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Term</label>
            <input type="number" name="term" value="{{ old('term', $grade->term) }}" class="form-control @error('term') is-invalid @enderror" min="1" required>
            @error('term') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Credit Hours</label>
            <input type="number" name="credit_hours" value="{{ old('credit_hours', $grade->credit_hours) }}" class="form-control @error('credit_hours') is-invalid @enderror" min="1" required>
            @error('credit_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Grade Point</label>
            <input type="number" step="0.01" name="grade_point" value="{{ old('grade_point', $grade->grade_point) }}" class="form-control @error('grade_point') is-invalid @enderror" min="0" max="4" required>
            @error('grade_point') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Update Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
