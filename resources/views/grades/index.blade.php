@extends('layouts.master')

@section('title', 'Grades List')

@section('content')
<div class="container mt-5">
    <h2>Grades by Term</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('grades.create') }}" class="btn btn-primary">Add New Grade</a>
    </div>

    @if(count($termsData) > 0)
        @foreach($termsData as $term => $data)
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <strong>Term {{ $term }}</strong> — Total Credit Hours: {{ $data['totalCH'] }}, GPA: {{ $data['gpa'] }}
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Credit Hours</th>
                            <th>Grade Point</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['grades'] as $grade)
                        <tr>
                            <td>{{ $grade->subject }}</td>
                            <td>{{ $grade->credit_hours }}</td>
                            <td>{{ $grade->grade_point }}</td>
                            <td>
                                <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('grades.destroy', $grade) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete this grade?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach

        <div class="alert alert-secondary">
            <strong>Cumulative CGPA:</strong> {{ $cgpa }} |
            <strong>Cumulative Credit Hours (CCH):</strong> {{ $totalCreditHoursAllTerms }}
        </div>
    @else
        <p>No grades found.</p>
    @endif
</div>
@endsection
