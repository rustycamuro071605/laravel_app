<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="futuristic-layout">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <div class="sidebar-content">
                <!-- User Profile Section -->
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>
                    <h3 class="user-name">Welcome Back</h3>
                    <p class="user-username">authenticate@system.dev</p>
                    <span class="user-status">
                        <i class="bi bi-circle-fill pulse me-1"></i>Secure Login
                    </span>
                </div>

                <!-- Navigation Menu -->
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link active">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="bi bi-person-plus"></i>
                            <span>Register</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('welcome') }}" class="nav-link">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                </ul>

                <!-- Security Info -->
                <div class="mt-auto pt-4 border-top border-dark">
                    <div class="text-center">
                        <p class="text-muted small mb-2">SECURITY STATUS</p>
                        <div class="d-flex justify-content-center gap-2">
                            <span class="badge bg-success-subtle text-success-emphasis">
                                <i class="bi bi-shield-lock me-1"></i>Encrypted
                            </span>
                            <span class="badge bg-info-subtle text-info-emphasis">
                                <i class="bi bi-lightning me-1"></i>Fast
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="current-date" id="currentDateTime"></div>
                <div class="user-actions">
                    <button class="futuristic-btn futuristic-btn-outline">
                        <i class="bi bi-question-circle"></i>
                        <span>Help</span>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Login Section -->
                <div class="welcome-section">
                    <h1 class="welcome-title">SECURE LOGIN</h1>
                    <p class="welcome-subtitle">Access your account with our advanced security system</p>
                    
                    <!-- Search Bar (repurposed as decorative element) -->
                    <div class="search-container">
                        <div class="search-bar text-center" style="pointer-events: none;">
                            <i class="bi bi-shield-lock me-2 neon-text"></i>
                            Authentication in Progress
                            <i class="bi bi-shield-lock ms-2 neon-text"></i>
                        </div>
                        <i class="bi bi-fingerprint search-icon"></i>
                    </div>
                </div>

                <!-- Login Form Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-person-badge"></i>
                                <span>ACCOUNT ACCESS</span>
                            </div>
                            
                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <!-- Username/Email -->
                                <div class="mb-4">
                                    <label for="login" class="form-label neon-text">
                                        <i class="bi bi-person me-2"></i>Username or Email
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark-subtle border-dark">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input id="login" 
                                               type="text" 
                                               name="login" 
                                               value="{{ old('login') }}" 
                                               class="form-control bg-dark border-dark text-white @error('login') is-invalid @enderror" 
                                               required 
                                               autofocus 
                                               placeholder="Enter your username or email">
                                    </div>
                                    @error('login')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label neon-text">
                                        <i class="bi bi-key me-2"></i>Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark-subtle border-dark">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input id="password" 
                                               type="password" 
                                               name="password" 
                                               class="form-control bg-dark border-dark text-white @error('password') is-invalid @enderror" 
                                               required 
                                               placeholder="Enter your password">
                                        <button class="btn btn-outline-secondary border-dark" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="remember" 
                                               id="remember" 
                                               {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted" for="remember">
                                            <i class="bi bi-check-circle me-2"></i>Remember this device
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="futuristic-btn w-100 py-3">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        <span>ACCESS DASHBOARD</span>
                                    </button>
                                </div>

                                <!-- Forgot Password Link -->
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none neon-text" href="{{ route('password.request') }}">
                                            <i class="bi bi-question-circle me-1"></i>Forgot your password?
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>

                        <!-- Test Credentials -->
                        <div class="futuristic-card mt-4">
                            <div class="card-header">
                                <i class="bi bi-key"></i>
                                <span>TEST CREDENTIALS</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <strong class="neon-text">Username:</strong> testuser1<br>
                                        <strong class="neon-text">Password:</strong> password123
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <strong class="neon-text">Username:</strong> testuser2<br>
                                        <strong class="neon-text">Password:</strong> password123
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
        }
        
        updateDateTime();
        setInterval(updateDateTime, 1000);
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html>
