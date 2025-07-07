<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }
    
    // Admin methods
    public function adminIndex()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }
    
    public function create()
    {
        return view('admin.services.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|in:kg,pcs',
            'duration_hours' => 'required|integer|min:1',
        ]);
        
        Service::create($request->all());
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }
    
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }
    
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|in:kg,pcs',
            'duration_hours' => 'required|integer|min:1',
        ]);
        
        $service->update($request->all());
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }
    
    public function destroy(Service $service)
    {
        $service->delete();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
