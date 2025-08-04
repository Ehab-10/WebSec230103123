<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WebSecService - @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
    }
    .navbar-brand {
      font-weight: bold;
    }
    .card {
      border: none;
      border-radius: 12px;
    }
  </style>
</head>
<body>
  @include('layouts.menu')

  <div class="container py-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
