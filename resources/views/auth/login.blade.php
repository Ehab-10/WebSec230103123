<x-guest-layout>
    <div class="text-center mb-4">
        <h3 class="welcome-text mb-1" style="font-size: 1.5rem; font-weight: 600;">Welcome Back</h3>
        <p class="text-muted small mb-0">Please sign in to your account</p>
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
            <label for="email" class="form-label small fw-medium mb-1">
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
            <label for="password" class="form-label small fw-medium mb-1">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label small" for="remember_me">
                    {{ __('Remember me') }}
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-dark fw-semibold py-2">
                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Log in') }}
            </button>
        </div>

        <!-- Divider -->
        <div class="position-relative text-center my-4">
            <hr class="text-muted">
            <span class="position-absolute top-50 start-50 translate-middle bg-dark px-2 small text-muted">
                or continue with
            </span>
        </div>

        <!-- Social Login Buttons -->
        <div class="d-grid gap-2 mb-4">
            <a href="{{ route('google.login') }}" class="btn btn-outline-light btn-sm d-flex align-items-center justify-content-center py-2">
                <i class="fab fa-google me-2"></i>Google
            </a>

            <a href="{{ url('/login/facebook') }}" class="btn btn-outline-light btn-sm d-flex align-items-center justify-content-center py-2">
                <i class="fab fa-facebook-f me-2"></i>Facebook
            </a>
            
            <a href="{{ url('/login/microsoft') }}" class="btn btn-outline-light btn-sm d-flex align-items-center justify-content-center py-2">
                <i class="fab fa-microsoft me-2"></i>Microsoft
            </a>
            
            <a href="{{ url('/login/linkedin') }}" class="btn btn-outline-light btn-sm d-flex align-items-center justify-content-center py-2">
                <i class="fab fa-linkedin-in me-2"></i>LinkedIn
            </a>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-4 pt-2 border-top">
            <p class="mb-0 small text-muted">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-dark">
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
