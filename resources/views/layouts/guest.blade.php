<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
            
            :root {
                --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 25%, #2d2d2d 50%, #1f1f1f 75%, #0f0f0f 100%);
                --glass-bg: rgba(15, 15, 15, 0.85);
                --glass-border: rgba(255, 255, 255, 0.08);
                --accent-purple: #8b5cf6;
                --accent-blue: #3b82f6;
                --accent-pink: #ec4899;
                --text-primary: #f8fafc;
                --text-secondary: rgba(248, 250, 252, 0.7);
                --text-muted: rgba(248, 250, 252, 0.5);
            }

            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background: var(--dark-gradient);
                min-height: 100vh;
                color: var(--text-primary);
                overflow-x: hidden;
                position: relative;
            }

            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
                pointer-events: none;
                z-index: -1;
            }

            .auth-card {
                background: var(--glass-bg);
                backdrop-filter: blur(25px) saturate(180%);
                border-radius: 24px;
                border: 1px solid var(--glass-border);
                box-shadow: 
                    0 32px 64px rgba(0, 0, 0, 0.4),
                    0 16px 32px rgba(0, 0, 0, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1),
                    inset 0 -1px 0 rgba(255, 255, 255, 0.05);
                position: relative;
                overflow: hidden;
                animation: cardSlideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .auth-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.5), transparent);
            }

            @keyframes cardSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(40px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .logo-container {
                background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(59, 130, 246, 0.2));
                border-radius: 50%;
                width: 90px;
                height: 90px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 
                    0 20px 40px rgba(139, 92, 246, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.2);
                margin-bottom: 2rem;
                border: 2px solid rgba(139, 92, 246, 0.3);
                position: relative;
                animation: logoFloat 3s ease-in-out infinite;
            }

            .logo-container::before {
                content: '';
                position: absolute;
                inset: -2px;
                border-radius: 50%;
                background: linear-gradient(45deg, var(--accent-purple), var(--accent-blue), var(--accent-pink));
                z-index: -1;
                animation: borderRotate 4s linear infinite;
            }

            @keyframes logoFloat {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            @keyframes borderRotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .form-control {
                background: rgba(20, 20, 20, 0.6);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: var(--text-primary);
                border-radius: 12px;
                padding: 12px 16px;
                font-size: 14px;
                font-weight: 400;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(10px);
            }

            .form-control-sm {
                padding: 8px 12px;
                font-size: 13px;
                border-radius: 8px;
            }

            .form-control:focus {
                background: rgba(25, 25, 25, 0.8);
                border-color: var(--accent-purple);
                box-shadow: 
                    0 0 0 3px rgba(139, 92, 246, 0.1),
                    0 8px 25px rgba(139, 92, 246, 0.15);
                color: var(--text-primary);
                transform: translateY(-2px);
            }

            .form-control::placeholder {
                color: var(--text-muted);
                font-weight: 400;
            }

            .form-label {
                color: var(--text-secondary);
                font-weight: 500;
                font-size: 14px;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
            }

            .form-label i {
                background: linear-gradient(45deg, var(--accent-purple), var(--accent-blue));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
                border: none;
                border-radius: 12px;
                font-weight: 600;
                padding: 12px 24px;
                font-size: 14px;
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 6px 20px rgba(139, 92, 246, 0.25);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.6s;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(139, 92, 246, 0.4);
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:active {
                transform: translateY(-1px);
            }

            .input-group .btn-outline-secondary {
                background: rgba(30, 30, 30, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: var(--text-secondary);
                border-radius: 0 16px 16px 0;
                transition: all 0.3s ease;
            }

            .input-group .btn-outline-secondary:hover {
                background: rgba(40, 40, 40, 0.9);
                color: var(--text-primary);
                transform: scale(1.05);
            }

            .social-btn {
                background: rgba(20, 20, 20, 0.6);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 16px;
                padding: 14px 24px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                backdrop-filter: blur(10px);
            }

            .social-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.05), transparent);
                transform: translateX(-100%);
                transition: transform 0.6s;
            }

            .social-btn:hover {
                transform: translateY(-2px);
                border-color: rgba(255, 255, 255, 0.2);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .social-btn:hover::before {
                transform: translateX(100%);
            }

            .btn-outline-danger {
                border-color: rgba(220, 53, 69, 0.3);
                color: #ff6b6b;
            }

            .btn-outline-danger:hover {
                background: rgba(220, 53, 69, 0.1);
                border-color: #dc3545;
                color: #ff8a80;
                box-shadow: 0 8px 25px rgba(220, 53, 69, 0.2);
            }

            .btn-outline-primary {
                border-color: rgba(13, 110, 253, 0.3);
                color: #60a5fa;
            }

            .btn-outline-primary:hover {
                background: rgba(13, 110, 253, 0.1);
                border-color: #0d6efd;
                color: #93c5fd;
                box-shadow: 0 8px 25px rgba(13, 110, 253, 0.2);
            }

            .btn-outline-dark {
                border-color: rgba(108, 117, 125, 0.3);
                color: #9ca3af;
            }

            .btn-outline-dark:hover {
                background: rgba(108, 117, 125, 0.1);
                border-color: #6c757d;
                color: #d1d5db;
                box-shadow: 0 8px 25px rgba(108, 117, 125, 0.2);
            }

            .btn-outline-info {
                border-color: rgba(13, 202, 240, 0.3);
                color: #67e8f9;
            }

            .btn-outline-info:hover {
                background: rgba(13, 202, 240, 0.1);
                border-color: #0dcaf0;
                color: #a5f3fc;
                box-shadow: 0 8px 25px rgba(13, 202, 240, 0.2);
            }

            /* Compact button styles */
            .btn-sm {
                padding: 8px 16px;
                font-size: 13px;
                border-radius: 8px;
            }

            .social-btn {
                padding: 10px 16px;
                font-size: 13px;
                border-radius: 8px;
            }

            .text-muted {
                color: var(--text-muted) !important;
            }

            .alert-success {
                background: rgba(34, 197, 94, 0.1);
                border: 1px solid rgba(34, 197, 94, 0.2);
                color: #86efac;
                border-radius: 16px;
                backdrop-filter: blur(10px);
            }

            .form-check-input {
                background: rgba(30, 30, 30, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 6px;
                width: 18px;
                height: 18px;
            }

            .form-check-input:checked {
                background: linear-gradient(45deg, var(--accent-purple), var(--accent-blue));
                border-color: var(--accent-purple);
                box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            }

            .form-check-label {
                color: var(--text-secondary);
                font-size: 14px;
            }

            a {
                color: var(--accent-purple);
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
            }

            a:hover {
                color: #a78bfa;
                text-shadow: 0 0 8px rgba(139, 92, 246, 0.5);
            }

            hr {
                border: none;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                margin: 24px 0;
            }

            .divider-line {
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(
                    90deg,
                    transparent 0%,
                    rgba(139, 92, 246, 0.3) 20%,
                    rgba(59, 130, 246, 0.4) 50%,
                    rgba(139, 92, 246, 0.3) 80%,
                    transparent 100%
                );
                transform: translateY(-50%);
            }

            .divider-content {
                position: relative;
                z-index: 2;
                display: inline-block;
            }

            .divider-text-enhanced {
                background: var(--glass-bg);
                padding: 8px 20px;
                border-radius: 25px;
                font-size: 13px;
                font-weight: 500;
                color: var(--text-muted);
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                box-shadow: 
                    0 4px 15px rgba(0, 0, 0, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .divider-text-enhanced::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(139, 92, 246, 0.1),
                    transparent
                );
                transition: left 0.6s ease;
            }

            .divider-text-enhanced:hover {
                transform: translateY(-1px);
                box-shadow: 
                    0 6px 20px rgba(0, 0, 0, 0.3),
                    inset 0 1px 0 rgba(255, 255, 255, 0.15);
                border-color: rgba(139, 92, 246, 0.3);
            }

            .divider-text-enhanced:hover::before {
                left: 100%;
            }

            .invalid-feedback {
                color: #fca5a5;
                font-size: 13px;
            }

            .is-invalid {
                border-color: #ef4444 !important;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
            }

            .welcome-text {
                background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 700;
                font-size: 28px;
                margin-bottom: 8px;
            }

            .welcome-subtitle {
                color: var(--text-muted);
                font-size: 15px;
                font-weight: 400;
            }

            @media (max-width: 768px) {
                .auth-card {
                    margin: 20px;
                    border-radius: 20px;
                }
                
                .logo-container {
                    width: 70px;
                    height: 70px;
                }
                
                .welcome-text {
                    font-size: 24px;
                }
            }

            .floating-shapes {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: -1;
            }

            .shape {
                position: absolute;
                border-radius: 50%;
                background: linear-gradient(45deg, rgba(139, 92, 246, 0.1), rgba(59, 130, 246, 0.1));
                animation: float 6s ease-in-out infinite;
            }

            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 60%;
                right: 10%;
                animation-delay: 2s;
            }

            .shape:nth-child(3) {
                width: 60px;
                height: 60px;
                bottom: 20%;
                left: 20%;
                animation-delay: 4s;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px) rotate(0deg);
                    opacity: 0.5;
                }
                50% {
                    transform: translateY(-20px) rotate(180deg);
                    opacity: 0.8;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100">
            <div class="row justify-content-center w-100">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-center mb-4">
                        <div class="logo-container mx-auto">
                            <a href="/" class="text-decoration-none">
                                <x-application-logo class="text-primary" style="width: 40px; height: 40px;" />
                            </a>
                        </div>
                    </div>

                    <div class="auth-card p-3 p-md-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
