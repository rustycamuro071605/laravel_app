<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>
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
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link">
                            <i class="bi bi-person-gear"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-activity"></i>
                            <span>Activity</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-question-circle"></i>
                            <span>Help</span>
                        </a>
                    </li>
                </ul>

                <!-- Account Information -->
                <div class="mt-auto pt-4 border-top border-dark">
                    <div class="text-center">
                        <p class="text-muted small mb-2">ACCOUNT INFO</p>
                        <p class="small mb-1">
                            <i class="bi bi-envelope me-1 neon-text"></i>
                            {{ Auth::user()->email }}
                        </p>
                        <p class="small mb-1">
                            <i class="bi bi-calendar me-1 neon-text"></i>
                            Member since {{ Auth::user()->created_at->format('M Y') }}
                        </p>
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
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
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <h1 class="welcome-title">WELCOME BACK</h1>
                    <p class="welcome-subtitle">You have successfully logged into your secure dashboard</p>
                    
                    <!-- Search Bar -->
                    <div class="search-container">
                        <input type="text" class="search-bar" placeholder="Type here to search...">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>

                <!-- User Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="stat-title">Username</div>
                        <div class="stat-value">{{ Auth::user()->username }}</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="stat-title">Email</div>
                        <div class="stat-value text-truncate">{{ Auth::user()->email }}</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="stat-title">Account Status</div>
                        <div class="stat-value">
                            <span class="badge bg-{{ Auth::user()->is_active ? 'success' : 'danger' }}-subtle text-{{ Auth::user()->is_active ? 'success' : 'danger' }}-emphasis px-3 py-2">
                                {{ Auth::user()->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-title">Last Login</div>
                        <div class="stat-value">
                            {{ Auth::user()->last_login ? Auth::user()->last_login->format('M d') : 'Never' }}
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="row mt-5 g-4">
                    <div class="col-lg-6">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-cpu"></i>
                                <span>SYSTEM INFORMATION</span>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <small class="neon-text">Laravel Version</small>
                                        <div class="mt-1 h5 mb-0">{{ app()->version() }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <small class="neon-text">PHP Version</small>
                                        <div class="mt-1 h5 mb-0">{{ PHP_VERSION }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <small class="neon-text">Total Users</small>
                                        <div class="mt-1 h5 mb-0">{{ \App\Models\User::count() }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-dark-subtle rounded">
                                        <small class="neon-text">Security</small>
                                        <div class="mt-1 h5 mb-0 text-success">Active</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="futuristic-card">
                            <div class="card-header">
                                <i class="bi bi-activity"></i>
                                <span>RECENT ACTIVITY</span>
                            </div>
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom border-dark">
                                <div class="flex-shrink-0">
                                    <div class="avatar bg-success-subtle text-success-emphasis rounded-circle">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Login Successful</h6>
                                    <p class="text-muted small mb-0">You've successfully accessed your dashboard</p>
                                </div>
                                <div class="text-muted small">
                                    {{ now()->format('H:i') }}
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar bg-info-subtle text-info-emphasis rounded-circle">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Account Secured</h6>
                                    <p class="text-muted small mb-0">Your session is protected with modern security</p>
                                </div>
                                <div class="text-muted small">
                                    Active
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-4">
                    <div class="futuristic-card">
                        <div class="card-header">
                            <i class="bi bi-lightning"></i>
                            <span>QUICK ACTIONS</span>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('profile.edit') }}" class="futuristic-btn">
                                <i class="bi bi-person-gear"></i>
                                <span>Edit Profile</span>
                            </a>
                            <button class="futuristic-btn futuristic-btn-outline" data-bs-toggle="modal" data-bs-target="#accountInfoModal">
                                <i class="bi bi-info-circle"></i>
                                <span>Account Details</span>
                            </button>
                            <button class="futuristic-btn futuristic-btn-outline">
                                <i class="bi bi-activity"></i>
                                <span>View Activity</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Info Modal -->
    <div class="modal fade" id="accountInfoModal" tabindex="-1" aria-labelledby="accountInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-dark">
                    <h5 class="modal-title neon-text" id="accountInfoModalLabel">
                        <i class="bi bi-person-vcard me-2"></i>Account Information
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="neon-text mb-3">Personal Details</h6>
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-muted">Full Name:</td>
                                    <td class="text-white">{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Username:</td>
                                    <td class="text-white">{{ Auth::user()->username }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email:</td>
                                    <td class="text-white">{{ Auth::user()->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="neon-text mb-3">Account Status</h6>
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-muted">Account Status:</td>
                                    <td>
                                        <span class="badge bg-{{ Auth::user()->is_active ? 'success' : 'danger' }}-subtle text-{{ Auth::user()->is_active ? 'success' : 'danger' }}-emphasis">
                                            {{ Auth::user()->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Member Since:</td>
                                    <td class="text-white">{{ Auth::user()->created_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Last Updated:</td>
                                    <td class="text-white">{{ Auth::user()->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-dark">
                    <button type="button" class="futuristic-btn futuristic-btn-outline" data-bs-dismiss="modal">Close</button>
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