@extends('layouts.master')

@section('title', 'Questions List')

@section('content')
<div class="container mt-5">
    <h2>Questions List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- زر إضافة سؤال جديد -->
    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Add New Question</a>

    <!-- زر بدء الامتحان -->
    <button class="btn btn-success mb-4" type="button" data-bs-toggle="collapse" data-bs-target="#examForm" aria-expanded="false" aria-controls="examForm">
        Start Exam
    </button>

    <!-- فورم الامتحان مخفي (Collapse) -->
    <div class="collapse" id="examForm">
        <form action="{{ route('questions.submit') }}" method="POST">
            @csrf

            @foreach($questions as $question)
            <div class="mb-4">
                <h5>{{ $loop->iteration }}. {{ $question->question_text }}</h5>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}o1" value="1" required>
                    <label class="form-check-label" for="q{{ $question->id }}o1">{{ $question->option1 }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}o2" value="2" required>
                    <label class="form-check-label" for="q{{ $question->id }}o2">{{ $question->option2 }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}o3" value="3" required>
                    <label class="form-check-label" for="q{{ $question->id }}o3">{{ $question->option3 }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}o4" value="4" required>
                    <label class="form-check-label" for="q{{ $question->id }}o4">{{ $question->option4 }}</label>
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Submit Exam</button>
        </form>
    </div>

    <!-- قائمة الأسئلة -->
    @if($questions->count() > 0)
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Correct Option</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $q)
            <tr>
                <td>{{ $q->id }}</td>
                <td>{{ $q->question_text }}</td>
                <td>{{ $q->option1 }}</td>
                <td>{{ $q->option2 }}</td>
                <td>{{ $q->option3 }}</td>
                <td>{{ $q->option4 }}</td>
                <td>{{ $q->correct_option }}</td>
                <td>
                    <a href="{{ route('questions.edit', $q) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('questions.destroy', $q) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No questions found.</p>
    @endif
</div>
@endsection
