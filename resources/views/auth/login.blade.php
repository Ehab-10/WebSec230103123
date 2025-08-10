<x-guest-layout>
    <div class="text-center mb-3">
        <h3 class="welcome-text mb-1">Welcome Back</h3>
        <p class="welcome-subtitle mb-0">Please sign in to your account</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-medium">
                <i class="fas fa-envelope me-1"></i>{{ __('Email') }}
            </label>
            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   placeholder="Enter your email address">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label small fw-medium">
                <i class="fas fa-lock me-1"></i>{{ __('Password') }}
            </label>
            <div class="input-group input-group-sm">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password" 
                       placeholder="Enter your password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label small" for="remember_me">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary fw-semibold py-2">
                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Log in') }}
            </button>
        </div>

        <div class="text-center mb-3">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                    <i class="fas fa-key me-1"></i>{{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Divider -->
        <div class="position-relative text-center my-3">
            <hr class="text-muted">
            <span class="position-absolute top-50 start-50 translate-middle bg-dark px-2 small text-muted">
                or continue with
            </span>
        </div>

        <!-- Social Login Buttons -->
        <div class="d-grid gap-2 mb-3">
            <a href="{{ url('/login/google') }}" class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center">
                <i class="fab fa-google me-2"></i>Continue with Google
            </a>
            
            <a href="{{ url('/login/facebook') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center">
                <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
            </a>
            
            <a href="{{ url('/login/microsoft') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center">
                <i class="fab fa-microsoft me-2"></i>Continue with Microsoft
            </a>
            
            <a href="{{ url('/login/linkedin') }}" class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-center">
                <i class="fab fa-linkedin-in me-2"></i>Continue with LinkedIn
            </a>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="mb-0 small text-muted">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                    Create one here
                </a>
            </p>
        </div>
    </form>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'text') {
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</x-guest-layout>
