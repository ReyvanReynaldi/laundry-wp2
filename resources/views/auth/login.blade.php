<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - {{ config('app.name', 'LaundryPro') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 0;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        .demo-credentials {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-left: 4px solid #667eea;
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="login-container d-flex align-items-center justify-content-center position-relative">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="container" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card login-card">
                        <div class="card-body p-5">
                            <!-- Logo & Title -->
                            <div class="text-center mb-4">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <i class="bi bi-droplet-fill text-primary me-2" style="font-size: 2.5rem;"></i>
                                    <h2 class="mb-0 fw-bold">LaundryPro</h2>
                                </div>
                                <h4 class="text-muted mb-0">Masuk ke Akun Anda</h4>
                                <p class="text-muted small">Kelola laundry dengan mudah dan efisien</p>
                            </div>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="Masukkan email Anda">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock me-2"></i>Password
                                    </label>
                                    <div class="position-relative">
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                               name="password" required autocomplete="current-password"
                                               placeholder="Masukkan password Anda">
                                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" 
                                                onclick="togglePassword()" style="border: none; background: none;">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                                            Lupa password?
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-login btn-primary w-100 btn-lg mb-4">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                </button>
                            </form>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                        Daftar sekarang
                                    </a>
                                </p>
                            </div>

                            <!-- Demo Credentials -->
                            <div class="demo-credentials p-3 rounded mt-4">
                                <h6 class="fw-bold mb-2">
                                    <i class="bi bi-info-circle me-2"></i>Demo Login
                                </h6>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="fw-semibold">Admin:</small><br>
                                        <small>admin@laundry.com</small>
                                    </div>
                                    <div class="col-6">
                                        <small class="fw-semibold">Customer:</small><br>
                                        <small>customer@email.com</small>
                                    </div>
                                </div>
                                <small class="text-muted">Password: <strong>password</strong></small>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center mt-3">
                        <a href="{{ url('/') }}" class="text-white text-decoration-none">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        // Auto-fill demo credentials
        document.addEventListener('DOMContentLoaded', function() {
            const demoCredentials = document.querySelector('.demo-credentials');
            if (demoCredentials) {
                demoCredentials.addEventListener('click', function(e) {
                    if (e.target.textContent.includes('admin@laundry.com')) {
                        document.getElementById('email').value = 'admin@laundry.com';
                        document.getElementById('password').value = 'password';
                    } else if (e.target.textContent.includes('customer@email.com')) {
                        document.getElementById('email').value = 'customer@email.com';
                        document.getElementById('password').value = 'password';
                    }
                });
            }
        });
    </script>
</body>
</html>
