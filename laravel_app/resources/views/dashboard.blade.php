<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arruginito's Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            background: rgba(99, 102, 241, 0.1);
            border-left: 4px solid #6366f1;
        }
        .user-row:hover {
            background: rgba(99, 102, 241, 0.05);
        }
        .pulse-dot {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Arruginito</h3>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
            
            <nav class="p-4">
                <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-indigo-600 bg-indigo-50">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('users.index') }}" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-indigo-600">
                    <i class="fas fa-users w-5"></i>
                    <span>User Management</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="sidebar-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:text-red-600 w-full text-left">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="glass-effect shadow-sm sticky top-0 z-10">
                <div class="flex items-center justify-between p-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                        <p class="text-gray-600">Welcome back, Arruginito</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Search users..." 
                                   class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                   onkeyup="if(event.key==='Enter') window.location.href='/users?search='+this.value">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="relative p-2 text-gray-600 hover:text-indigo-600">
                                <i class="fas fa-bell text-xl"></i>
                                @if($inactiveUsers > 0)
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full pulse-dot"></span>
                                @endif
                            </button>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('users.create') }}" 
                               class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-plus mr-2"></i>Add User
                            </a>
                            <a href="{{ route('users.export') }}" 
                               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-download mr-2"></i>Export
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card p-6 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/80 text-sm">Total Users</p>
                                <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                                <p class="text-white/60 text-xs mt-1">All registered users</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/80 text-sm">Active Users</p>
                                <p class="text-3xl font-bold">{{ $activeUsers }}</p>
                                <p class="text-white/60 text-xs mt-1">{{ $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0 }}% of total</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/80 text-sm">Inactive Users</p>
                                <p class="text-3xl font-bold">{{ $inactiveUsers }}</p>
                                <p class="text-white/60 text-xs mt-1">Need attention</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-times text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card p-6 rounded-xl text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/80 text-sm">New This Week</p>
                                <p class="text-3xl font-bold">{{ $userRegistrations->sum('count') }}</p>
                                <p class="text-white/60 text-xs mt-1">Last 7 days</p>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Users & Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Users -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Users</h2>
                            <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        
                        @if($recentUsers->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentUsers as $user)
                            <div class="user-row flex items-center justify-between p-3 rounded-lg transition cursor-pointer"
                                 onclick="window.location.href='{{ route('users.show', $user->id) }}'">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-{{ $user->is_active ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-{{ $user->is_active ? 'green' : 'red' }}-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-2 py-1 text-xs rounded-full bg-{{ $user->is_active ? 'green' : 'red' }}-100 text-{{ $user->is_active ? 'green' : 'red' }}-800">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-users text-4xl mb-3"></i>
                            <p>No users found</p>
                        </div>
                        @endif
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                            <button onclick="location.reload()" class="text-indigo-600 hover:text-indigo-700 text-sm">
                                <i class="fas fa-sync-alt mr-1"></i> Refresh
                            </button>
                        </div>
                        
                        @if($recentLogins->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentLogins as $login)
                            <div class="flex items-center space-x-3 p-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $login->name }} logged in</p>
                                    <p class="text-sm text-gray-500">{{ $login->last_login ? $login->last_login->diffForHumans() : 'Never' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-sign-in-alt text-4xl mb-3"></i>
                            <p>No recent activity</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions & Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Actions</h2>
                        <div class="space-y-3">
                            <a href="{{ route('users.create') }}" 
                               class="flex items-center space-x-3 p-3 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                <i class="fas fa-user-plus text-indigo-600"></i>
                                <span class="text-gray-700">Add New User</span>
                            </a>
                            <a href="{{ route('users.index') }}" 
                               class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                <i class="fas fa-list text-blue-600"></i>
                                <span class="text-gray-700">View All Users</span>
                            </a>
                            <a href="{{ route('users.export') }}" 
                               class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg hover:bg-green-100 transition">
                                <i class="fas fa-download text-green-600"></i>
                                <span class="text-gray-700">Export Data</span>
                            </a>
                            <button onclick="location.reload()" 
                                    class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition w-full">
                                <i class="fas fa-sync-alt text-yellow-600"></i>
                                <span class="text-gray-700">Refresh Dashboard</span>
                            </button>
                        </div>
                    </div>

                    <!-- User Statistics -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">User Statistics</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Users</span>
                                <span class="font-semibold text-gray-800">{{ $totalUsers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Active Users</span>
                                <span class="font-semibold text-green-600">{{ $activeUsers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Inactive Users</span>
                                <span class="font-semibold text-red-600">{{ $inactiveUsers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">New This Week</span>
                                <span class="font-semibold text-blue-600">{{ $userRegistrations->sum('count') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Engagement Rate</span>
                                <span class="font-semibold text-indigo-600">{{ $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">System Info</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">System Status</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Online</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Last Update</span>
                                <span class="text-sm text-gray-800">{{ now()->format('M d, H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Database</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Connected</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Version</span>
                                <span class="text-sm text-gray-800">v1.0.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Auto-refresh every 30 seconds
        setInterval(() => {
            console.log('Dashboard data refreshed');
        }, 30000);
    </script>
</body>
</html>
