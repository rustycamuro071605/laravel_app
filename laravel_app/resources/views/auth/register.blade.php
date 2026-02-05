<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>
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
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h3 class="user-name">New Account</h3>
                    <p class="user-username">register@system.dev</p>
                    <span class="user-status">
                        <i class="bi bi-circle-fill pulse me-1"></i>Registration
                    </span>
                </div>

                <!-- Navigation Menu -->
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link active">
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
                        <p class="text-muted small mb-2">SECURITY FEATURES</p>
                        <div class="d-flex justify-content-center gap-2">
                            <span class="badge bg-success-subtle text-success-emphasis">
                                <i class="bi bi-shield-check me-1"></i>Verified
                            </span>
                            <span class="badge bg-info-subtle text-info-emphasis">
                                <i class="bi bi-stars me-1"></i>Premium
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
                <!-- Registration Section -->
                <div class="welcome-section">
                    <h1 class="welcome-title">CREATE ACCOUNT</h1>
                    <p class="welcome-subtitle">Join our secure platform and experience next-generation authentication</p>
                    
                    <!-- Decorative Element -->
                    <div class="search-container">
                        <div class="search-bar text-center" style="pointer-events: none;">
                            <i class="bi bi-person-plus me-2 neon-text"></i>
                            Account Setup in Progress
                            <i class="bi bi-person-plus ms-2 neon-text"></i>
                        </div>
                        <i class="bi bi-person-badge search-icon"></i>
                    </div>
                </div>

                <!-- Registration Form Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-person-vcard"></i>
                                <span>ACCOUNT REGISTRATION</span>
                            </div>
                            
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <!-- Username -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="username" class="form-label neon-text">
                                            <i class="bi bi-person me-2"></i>Username *
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-subtle border-dark">
                                                <i class="bi bi-at"></i>
                                            </span>
                                            <input id="username" 
                                                   type="text" 
                                                   name="username" 
                                                   value="{{ old('username') }}" 
                                                   class="form-control bg-dark border-dark text-white @error('username') is-invalid @enderror" 
                                                   required 
                                                   placeholder="Choose a unique username">
                                        </div>
                                        @error('username')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label neon-text">
                                            <i class="bi bi-person-badge me-2"></i>Full Name *
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-subtle border-dark">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input id="name" 
                                                   type="text" 
                                                   name="name" 
                                                   value="{{ old('name') }}" 
                                                   class="form-control bg-dark border-dark text-white @error('name') is-invalid @enderror" 
                                                   required 
                                                   placeholder="Enter your full name">
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="form-label neon-text">
                                        <i class="bi bi-envelope me-2"></i>Email Address *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark-subtle border-dark">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input id="email" 
                                               type="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               class="form-control bg-dark border-dark text-white @error('email') is-invalid @enderror" 
                                               required 
                                               placeholder="Enter your email address">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label neon-text">
                                            <i class="bi bi-key me-2"></i>Password *
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
                                                   placeholder="Create a strong password">
                                            <button class="btn btn-outline-secondary border-dark" type="button" id="togglePassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text text-muted mt-2">
                                            <i class="bi bi-info-circle me-1"></i>Must be at least 8 characters
                                        </div>
                                    </div>
                                    
                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label neon-text">
                                            <i class="bi bi-shield-check me-2"></i>Confirm Password *
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark-subtle border-dark">
                                                <i class="bi bi-lock-fill"></i>
                                            </span>
                                            <input id="password_confirmation" 
                                                   type="password" 
                                                   name="password_confirmation" 
                                                   class="form-control bg-dark border-dark text-white @error('password_confirmation') is-invalid @enderror" 
                                                   required 
                                                   placeholder="Confirm your password">
                                            <button class="btn btn-outline-secondary border-dark" type="button" id="toggleConfirmPassword">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">
                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Terms Agreement -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="terms" 
                                               id="terms" 
                                               required>
                                        <label class="form-check-label text-muted" for="terms">
                                            <i class="bi bi-file-text me-2"></i>I agree to the 
                                            <a href="#" class="neon-text text-decoration-none">Terms of Service</a> 
                                            and 
                                            <a href="#" class="neon-text text-decoration-none">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-4">
                                    <button type="submit" class="futuristic-btn w-100 py-3">
                                        <i class="bi bi-person-plus me-2"></i>
                                        <span>CREATE ACCOUNT</span>
                                    </button>
                                </div>

                                <!-- Login Link -->
                                <div class="text-center">
                                    <a class="text-decoration-none neon-text" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Already have an account? Login here
                                    </a>
                                </div>
                            </form>
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
        
        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
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
