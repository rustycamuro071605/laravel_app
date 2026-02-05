<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h3 class="user-name">Welcome Guest</h3>
                    <p class="user-username">system@laravel.dev</p>
                    <span class="user-status">
                        <i class="bi bi-circle-fill pulse me-1"></i>Online
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
                        <a href="#" class="nav-link">
                            <i class="bi bi-info-circle"></i>
                            <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-question-circle"></i>
                            <span>Help</span>
                        </a>
                    </li>
                </ul>

                <!-- System Status -->
                <div class="mt-auto pt-4 border-top border-dark">
                    <div class="text-center">
                        <p class="text-muted small mb-2">SYSTEM STATUS</p>
                        <div class="d-flex justify-content-center gap-3">
                            <span class="badge bg-success-subtle text-success-emphasis">
                                <i class="bi bi-server me-1"></i>Online
                            </span>
                            <span class="badge bg-info-subtle text-info-emphasis">
                                <i class="bi bi-shield-lock me-1"></i>Secure
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
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h1 class="welcome-title">WELCOME TO LARAVEL</h1>
                    <p class="welcome-subtitle">Secure User Authentication Dashboard</p>
                    
                    <!-- Search Bar -->
                    <div class="search-container">
                        <input type="text" class="search-bar" placeholder="Type here to search..." readonly>
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value">{{ \App\Models\User::count() }}</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div class="stat-title">Security Level</div>
                        <div class="stat-value">A+</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div class="stat-title">Performance</div>
                        <div class="stat-value">99.9%</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="stat-title">Uptime</div>
                        <div class="stat-value">24/7</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-5">
                    <div class="futuristic-card">
                        <div class="card-header">
                            <i class="bi bi-lightning"></i>
                            <span>QUICK ACTIONS</span>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('login') }}" class="futuristic-btn">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login to Dashboard</span>
                            </a>
                            <a href="{{ route('register') }}" class="futuristic-btn futuristic-btn-outline">
                                <i class="bi bi-person-plus"></i>
                                <span>Create Account</span>
                            </a>
                            <button class="futuristic-btn futuristic-btn-outline">
                                <i class="bi bi-info-circle"></i>
                                <span>System Info</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Test Credentials -->
                <div class="mt-4 text-center">
                    <div class="futuristic-card">
                        <div class="card-header">
                            <i class="bi bi-key"></i>
                            <span>TEST CREDENTIALS</span>
                        </div>
                        <p class="text-muted mb-3">Use these credentials to test the login functionality:</p>
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
    </script>
</body>
</html>