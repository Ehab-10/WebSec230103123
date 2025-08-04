@extends('layouts.master')

@section('title', 'Add Grade')

@section('content')
<div class="container mt-5">
    <h2>Add New Grade</h2>

    <form method="POST" action="{{ route('grades.store') }}">
        @csrf

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" required>
            @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Term (e.g. 1, 2, 3)</label>
            <input type="number" name="term" value="{{ old('term') }}" class="form-control @error('term') is-invalid @enderror" min="1" required>
            @error('term') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Credit Hours</label>
            <input type="number" name="credit_hours" value="{{ old('credit_hours') }}" class="form-control @error('credit_hours') is-invalid @enderror" min="1" required>
            @error('credit_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Grade Point (0.00 - 4.00)</label>
            <input type="number" step="0.01" name="grade_point" value="{{ old('grade_point') }}" class="form-control @error('grade_point') is-invalid @enderror" min="0" max="4" required>
            @error('grade_point') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Save Grade</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
