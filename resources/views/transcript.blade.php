@extends('layouts.master')
@section('title', 'Transcript')

@section('content')
<div class="card shadow">
  <div class="card-header bg-secondary text-white">
    📄 Student Transcript
  </div>
  <div class="card-body">
    <table class="table table-striped text-center">
      <thead class="table-dark">
        <tr>
          <th>Course Code</th>
          <th>Title</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody>
        @foreach($courses as $course)
          <tr>
            <td>{{ $course['code'] }}</td>
            <td>{{ $course['title'] }}</td>
            <td class="fw-bold">{{ $course['grade'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
