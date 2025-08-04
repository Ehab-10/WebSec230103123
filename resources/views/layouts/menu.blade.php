<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">WebSec</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse show" id="navbarMenu">
      <!-- Public Links -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/even">Even</a></li>
        <li class="nav-item"><a class="nav-link" href="/prime">Prime</a></li>
        <li class="nav-item"><a class="nav-link" href="/multable">Multiplication</a></li>
        <li class="nav-item"><a class="nav-link" href="/minitest">Mini Test</a></li>
        <li class="nav-item"><a class="nav-link" href="/calculator">Calculator</a></li>

        @auth
          @if (auth()->user()->admin)
            <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('permissions.index') }}">Permissions</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"> Users</a></li>
          @endif

          <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="/gpa">GPA Simulator</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('grades.index') }}">Grades</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('questions.index') }}">Questions</a></li>
        @endauth
      </ul>

      <!-- Right Side: Login/Profile -->
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
              </li>
            </ul>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
