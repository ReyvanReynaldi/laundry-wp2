<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }

        abort(403, 'Unauthorized.');
    }

    public function customerDashboard()
    {
        $user = Auth::user();
        
        \Log::info('Customer Dashboard - User: ' . $user->name . ', Role: ' . $user->role);
        
        // Ensure only customers can access this
        if ($user->role !== 'customer') {
            \Log::info('Non-customer trying to access customer dashboard, redirecting to admin');
            return redirect()->route('admin.dashboard');
        }
        
        $activeOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'processing', 'ready'])
            ->with('service')
            ->latest()
            ->get();
            
        $orderHistory = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with('service')
            ->latest()
            ->take(10)
            ->get();
            
        $stats = [
            'active_orders' => $activeOrders->count(),
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'total_spent' => Order::where('user_id', $user->id)->where('status', 'completed')->sum('total_amount'),
            'reward_points' => $user->reward_points ?? 0,
        ];
        
        return view('customer.dashboard', compact('activeOrders', 'orderHistory', 'stats'));
    }
    
    public function adminDashboard()
    {
        $user = Auth::user();
        
        \Log::info('Admin Dashboard - User: ' . $user->name . ', Role: ' . $user->role);
        
        // Ensure only admins can access this
        if ($user->role !== 'admin') {
            \Log::info('Non-admin trying to access admin dashboard, redirecting to customer');
            return redirect()->route('customer.dashboard');
        }
        
        $today = Carbon::today();
        
        $todayStats = [
            'total_orders' => Order::whereDate('created_at', $today)->count(),
            'completed_orders' => Order::whereDate('created_at', $today)->where('status', 'completed')->count(),
            'pending_orders' => Order::whereDate('created_at', $today)->whereIn('status', ['pending', 'processing'])->count(),
            'revenue' => Order::whereDate('created_at', $today)->where('status', 'completed')->sum('total_amount'),
            'new_customers' => User::whereDate('created_at', $today)->where('role', 'customer')->count(),
        ];
        
        $recentOrders = Order::with(['user', 'service'])
            ->latest()
            ->take(10)
            ->get();
            
        $weeklyRevenue = Order::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        \Log::info('Admin Dashboard - Rendering admin view');
        return view('admin.dashboard', compact('todayStats', 'recentOrders', 'weeklyRevenue'));
    }
}
