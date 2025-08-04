@extends('layouts.master')
@section('title', 'Calculator')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
  <div class="card-header bg-info text-white">
    🔢 Simple Calculator
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label>First Number</label>
      <input type="number" id="num1" class="form-control">
    </div>
    <div class="mb-3">
      <label>Second Number</label>
      <input type="number" id="num2" class="form-control">
    </div>

    <div class="d-flex justify-content-between mb-3">
      <button class="btn btn-outline-primary" onclick="calculate('+')">+</button>
      <button class="btn btn-outline-secondary" onclick="calculate('-')">−</button>
      <button class="btn btn-outline-success" onclick="calculate('*')">×</button>
      <button class="btn btn-outline-danger" onclick="calculate('/')">÷</button>
    </div>

    <div class="alert alert-warning text-center fw-bold fs-5" id="result">
      Result will appear here
    </div>
  </div>
</div>

<script>
function calculate(op) {
  const n1 = parseFloat(document.getElementById('num1').value);
  const n2 = parseFloat(document.getElementById('num2').value);
  let result;

  if (isNaN(n1) || isNaN(n2)) {
    result = 'Please enter valid numbers';
  } else {
    switch(op) {
      case '+': result = n1 + n2; break;
      case '-': result = n1 - n2; break;
      case '*': result = n1 * n2; break;
      case '/':
        if (n2 === 0) result = 'Cannot divide by zero';
        else result = n1 / n2;
        break;
    }
  }

  document.getElementById('result').innerText = `Result: ${result}`;
}
</script>
@endsection
