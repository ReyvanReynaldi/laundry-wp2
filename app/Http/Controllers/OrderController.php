<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('service')
            ->latest()
            ->paginate(10);
            
        return view('customer.orders.index', compact('orders'));
    }
    
    public function create()
    {
        $services = Service::where('is_active', true)->get();
        return view('customer.orders.create', compact('services'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'weight' => 'required|numeric|min:0.5',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|string',
            'delivery_date' => 'required|date|after:pickup_date',
            'delivery_time' => 'required|string',
            'pickup_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $service = Service::findOrFail($request->service_id);
        $totalAmount = $service->price * $request->weight;
        
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'weight' => $request->weight,
            'total_amount' => $totalAmount,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'pickup_address' => $request->pickup_address,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
        
        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);
    }
    
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        
        $order->load('service', 'user');
        return view('customer.orders.show', compact('order'));
    }
    
    public function track(Request $request)
    {
        if ($request->has('order_number')) {
            $order = Order::where('order_number', $request->order_number)
                ->with('service')
                ->first();
                
            if (!$order) {
                return back()->with('error', 'Nomor pesanan tidak ditemukan.');
            }
            
            return view('customer.orders.track', compact('order'));
        }
        
        return view('customer.orders.track');
    }
    
    // Admin methods
    public function adminIndex()
    {
        $orders = Order::with(['user', 'service'])
            ->latest()
            ->paginate(15);
            
        return view('admin.orders.index', compact('orders'));
    }
    
    public function adminShow(Order $order)
    {
        $order->load('service', 'user');
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled',
        ]);
        
        $order->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);
        
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
