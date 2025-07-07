<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $analytics = $this->getAnalyticsData();
        return view('admin.analytics', compact('analytics'));
    }

    public function realtime()
    {
        $analytics = $this->getAnalyticsData();
        return response()->json($analytics);
    }

    private function getAnalyticsData()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Revenue data
        $todayRevenue = Order::whereDate('created_at', $today)
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $thisMonthRevenue = Order::where('created_at', '>=', $thisMonth)
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $lastMonthRevenue = Order::whereBetween('created_at', [$lastMonth, $thisMonth])
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        // Order statistics
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $thisMonthOrders = Order::where('created_at', '>=', $thisMonth)->count();
        $lastMonthOrders = Order::whereBetween('created_at', [$lastMonth, $thisMonth])->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Customer statistics
        $activeCustomers = User::where('role', 'customer')
            ->whereHas('orders', function($query) use ($thisMonth) {
                $query->where('created_at', '>=', $thisMonth);
            })->count();

        $thisMonthCustomers = User::where('role', 'customer')
            ->where('created_at', '>=', $thisMonth)->count();

        $lastMonthCustomers = User::where('role', 'customer')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])->count();

        // Growth calculations
        $revenueGrowth = $lastMonthRevenue > 0 ? 
            round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1) : 0;

        $orderGrowth = $lastMonthOrders > 0 ? 
            round((($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 1) : 0;

        $customerGrowth = $lastMonthCustomers > 0 ? 
            round((($thisMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100, 1) : 0;

        // Daily revenue for chart (last 30 days)
        $dailyRevenue = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('status', '!=', 'cancelled')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Status distribution
        $statusDistribution = Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Service performance
        $services = Service::withCount('orders')
            ->withSum('orders', 'total_amount')
            ->get()
            ->map(function ($service) {
                return [
                    'name' => $service->name,
                    'orders_count' => $service->orders_count ?? 0,
                    'revenue' => $service->orders_sum_total_amount ?? 0
                ];
            });

        // Top customers
        $topCustomers = User::where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total_amount')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        // Hourly orders (today)
        $hourlyOrders = Order::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as orders')
            )
            ->whereDate('created_at', $today)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // Peak hours (last 7 days)
        $peakHours = Order::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as orders')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('hour')
            ->orderBy('orders', 'desc')
            ->limit(5)
            ->get();

        return [
            'revenue' => [
                'today' => $todayRevenue,
                'this_month' => $thisMonthRevenue,
                'growth' => $revenueGrowth
            ],
            'orders' => [
                'today_orders' => $todayOrders,
                'this_month_orders' => $thisMonthOrders,
                'pending_orders' => $pendingOrders
            ],
            'customers' => [
                'active_customers' => $activeCustomers,
                'this_month_customers' => $thisMonthCustomers
            ],
            'growth' => [
                'revenue_growth' => $revenueGrowth,
                'order_growth' => $orderGrowth,
                'customer_growth' => $customerGrowth
            ],
            'daily_revenue' => $dailyRevenue,
            'status_distribution' => $statusDistribution,
            'services' => $services,
            'top_customers' => $topCustomers,
            'hourly_orders' => $hourlyOrders,
            'peak_hours' => $peakHours
        ];
    }
}
