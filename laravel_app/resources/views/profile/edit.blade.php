<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - {{ config('app.name', 'Laravel') }}</title>
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
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h3 class="user-name">{{ Auth::user()->name }}</h3>
                    <p class="user-username">{{ Auth::user()->username }}</p>
                    <span class="user-status">
                        <i class="bi bi-circle-fill pulse me-1"></i>
                        @if(Auth::user()->is_active)
                            Active
                        @else
                            Inactive
                        @endif
                    </span>
                </div>

                <!-- Navigation Menu -->
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link active">
                            <i class="bi bi-person-gear"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-shield-lock"></i>
                            <span>Security</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>

                <!-- Account Information -->
                <div class="mt-auto pt-4 border-top border-dark">
                    <div class="text-center">
                        <p class="text-muted small mb-2">ACCOUNT ACTIONS</p>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="futuristic-btn futuristic-btn-outline w-100">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
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
                        <i class="bi bi-bell"></i>
                        <span>Notifications</span>
                    </button>
                    <button class="futuristic-btn futuristic-btn-outline">
                        <i class="bi bi-question-circle"></i>
                        <span>Help</span>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Profile Section -->
                <div class="welcome-section">
                    <h1 class="welcome-title">ACCOUNT SETTINGS</h1>
                    <p class="welcome-subtitle">Manage your profile information and account security</p>
                    
                    <!-- Decorative Element -->
                    <div class="search-container">
                        <div class="search-bar text-center" style="pointer-events: none;">
                            <i class="bi bi-person-gear me-2 neon-text"></i>
                            Profile Management Active
                            <i class="bi bi-person-gear ms-2 neon-text"></i>
                        </div>
                        <i class="bi bi-gear search-icon"></i>
                    </div>
                </div>

                <!-- Profile Information Card -->
                <div class="row mb-5">
                    <div class="col-lg-8">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-person-badge"></i>
                                <span>PROFILE INFORMATION</span>
                            </div>
                            
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-info-circle"></i>
                                <span>ACCOUNT STATUS</span>
                            </div>
                            <div class="text-center">
                                <div class="user-avatar mx-auto mb-3" style="width: 100px; height: 100px;">
                                    <i class="bi bi-person-fill" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="neon-text mb-3">{{ Auth::user()->name }}</h5>
                                <p class="text-muted mb-3">{{ Auth::user()->username }}</p>
                                
                                <div class="d-grid gap-2">
                                    <span class="badge bg-{{ Auth::user()->is_active ? 'success' : 'danger' }}-subtle text-{{ Auth::user()->is_active ? 'success' : 'danger' }}-emphasis py-2">
                                        <i class="bi bi-shield-check me-1"></i>
                                        {{ Auth::user()->is_active ? 'Active Account' : 'Inactive Account' }}
                                    </span>
                                    <span class="badge bg-info-subtle text-info-emphasis py-2">
                                        <i class="bi bi-calendar me-1"></i>
                                        Member since {{ Auth::user()->created_at->format('M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Update Card -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-key"></i>
                                <span>UPDATE PASSWORD</span>
                            </div>
                            
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Account Deletion Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-exclamation-triangle"></i>
                                <span>ACCOUNT DELETION</span>
                            </div>
                            
                            @include('profile.partials.delete-user-form')
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
        
        // Toggle password visibility for all password fields
        document.querySelectorAll('[id^="togglePassword"]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
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
        });
    </script>
</body>
</html>
