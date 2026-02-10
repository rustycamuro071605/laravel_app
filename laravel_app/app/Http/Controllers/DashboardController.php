<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get user statistics
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();
        $recentUsers = User::latest()->take(5)->get();
        
        // Get user registration data for the last 7 days
        $userRegistrations = User::where('created_at', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->orderBy('date', 'asc')
            ->get();
        
        // Get users by creation month
        $usersByMonth = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();
        
        // Get latest login activities
        $recentLogins = User::whereNotNull('last_login')
            ->orderBy('last_login', 'desc')
            ->take(10)
            ->get();
        
        return view('dashboard', compact(
            'totalUsers',
            'activeUsers', 
            'inactiveUsers',
            'recentUsers',
            'userRegistrations',
            'usersByMonth',
            'recentLogins'
        ));
    }
}
