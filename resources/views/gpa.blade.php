@extends('layouts.master')
@section('title', 'GPA Simulator')

@section('content')
<div class="card shadow">
  <div class="card-header bg-dark text-white">
    🎓 GPA Simulator (Dynamic Input)
  </div>
  <div class="card-body">
    <form id="gpaForm">
      <table class="table table-bordered text-center align-middle" id="coursesTable">
        <thead class="table-secondary">
          <tr>
            <th>Course Code</th>
            <th>Title</th>
            <th>Credit Hours</th>
            <th>Grade (%)</th>
            <th><button type="button" class="btn btn-sm btn-primary" onclick="addRow()">Add Course</button></th>
          </tr>
        </thead>
        <tbody>
          <!-- أول صف افتراضي -->
          <tr>
            <td><input type="text" name="code[]" class="form-control" required></td>
            <td><input type="text" name="title[]" class="form-control" required></td>
            <td><input type="number" name="credit[]" class="form-control" min="0" step="0.5" required></td>
            <td><input type="number" name="grade[]" class="form-control" min="0" max="100" required></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button></td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success" onclick="calculateGPA()">Calculate GPA</button>
      </div>
    </form>

    <div class="mt-4 alert alert-primary fw-bold fs-5 text-center" id="gpaResult">
      GPA will appear here.
    </div>
  </div>
</div>

<script>
function addRow() {
  const tbody = document.getElementById('coursesTable').querySelector('tbody');
  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td><input type="text" name="code[]" class="form-control" required></td>
    <td><input type="text" name="title[]" class="form-control" required></td>
    <td><input type="number" name="credit[]" class="form-control" min="0" step="0.5" required></td>
    <td><input type="number" name="grade[]" class="form-control" min="0" max="100" required></td>
    <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Remove</button></td>
  `;
  tbody.appendChild(newRow);
}

function removeRow(button) {
  const row = button.closest('tr');
  row.remove();
}

function calculateGPA() {
  const grades = document.getElementsByName('grade[]');
  const credits = document.getElementsByName('credit[]');

  let totalPoints = 0;
  let totalCredits = 0;

  for (let i = 0; i < grades.length; i++) {
    const grade = parseFloat(grades[i].value);
    const credit = parseFloat(credits[i].value);

    if (isNaN(grade) || grade < 0 || grade > 100) {
      alert("Please enter valid grades between 0 and 100.");
      return;
    }
    if (isNaN(credit) || credit <= 0) {
      alert("Please enter valid credit hours greater than 0.");
      return;
    }

    let point = 0;
    if (grade >= 90) point = 4.0;
    else if (grade >= 85) point = 3.7;
    else if (grade >= 80) point = 3.3;
    else if (grade >= 75) point = 3.0;
    else if (grade >= 70) point = 2.7;
    else if (grade >= 65) point = 2.3;
    else if (grade >= 60) point = 2.0;
    else if (grade >= 50) point = 1.0;
    else point = 0;

    totalPoints += point * credit;
    totalCredits += credit;
  }

  if (totalCredits === 0) {
    alert("Please add courses with credit hours.");
    return;
  }

  const gpa = (totalPoints / totalCredits).toFixed(2);
  document.getElementById('gpaResult').innerText = `Your GPA is: ${gpa}`;
}
</script>
@endsection
