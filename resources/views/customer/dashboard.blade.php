<x-app-layout>
    <div class="container-fluid py-4" style="background: #f8f9fa;">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <div class="text-white">
                                        <h2 class="mb-2 fw-bold">
                                            <i class="bi bi-house-heart me-3"></i>Selamat Datang, {{ auth()->user()->name }}!
                                        </h2>
                                        <p class="mb-3 opacity-75">Kelola pesanan laundry Anda dengan mudah dan nyaman</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('customer.orders.create') }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-plus-circle me-1"></i>Pesan Sekarang
                                            </a>
                                            <a href="{{ route('orders.track') }}" class="btn btn-outline-light btn-sm">
                                                <i class="bi bi-search me-1"></i>Lacak Pesanan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-none d-md-block">
                                <div class="h-100 d-flex align-items-center justify-content-center p-4" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);">
                                    <i class="bi bi-droplet-fill text-white" style="font-size: 5rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-box-seam text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="text-primary fw-bold mb-1">{{ $stats['active_orders'] }}</h3>
                        <p class="text-muted mb-0">Pesanan Aktif</p>
                        @if($stats['active_orders'] > 0)
                            <small class="text-success">
                                <i class="bi bi-arrow-up me-1"></i>Ada pesanan berjalan
                            </small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="text-success fw-bold mb-1">{{ $stats['total_orders'] }}</h3>
                        <p class="text-muted mb-0">Total Pesanan</p>
                        <small class="text-muted">Sepanjang masa</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-currency-dollar text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="text-warning fw-bold mb-1">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Total Pengeluaran</p>
                        <small class="text-success">
                            <i class="bi bi-piggy-bank me-1"></i>Hemat 15%
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-star text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 class="text-info fw-bold mb-1">{{ $stats['reward_points'] }}</h3>
                        <p class="text-muted mb-0">Poin Reward</p>
                        <small class="text-info">
                            <i class="bi bi-gift me-1"></i>Tukar hadiah
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('customer.orders.create') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-primary bg-opacity-10 h-100 hover-card">
                                        <div class="card-body text-center p-4">
                                            <i class="bi bi-plus-circle text-primary mb-3" style="font-size: 2.5rem;"></i>
                                            <h6 class="fw-bold text-primary mb-2">Pesan Laundry</h6>
                                            <p class="text-muted small mb-0">Buat pesanan baru dengan mudah</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('orders.track') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-success bg-opacity-10 h-100 hover-card">
                                        <div class="card-body text-center p-4">
                                            <i class="bi bi-search text-success mb-3" style="font-size: 2.5rem;"></i>
                                            <h6 class="fw-bold text-success mb-2">Lacak Pesanan</h6>
                                            <p class="text-muted small mb-0">Pantau status pesanan real-time</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-warning bg-opacity-10 h-100 hover-card">
                                        <div class="card-body text-center p-4">
                                            <i class="bi bi-person text-warning mb-3" style="font-size: 2.5rem;"></i>
                                            <h6 class="fw-bold text-warning mb-2">Profil Saya</h6>
                                            <p class="text-muted small mb-0">Kelola informasi akun</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <ul class="nav nav-pills card-header-pills" id="orderTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="active-tab" data-bs-toggle="pill" data-bs-target="#active" type="button" role="tab">
                                    <i class="bi bi-clock me-2"></i>Pesanan Aktif ({{ $activeOrders->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab">
                                    <i class="bi bi-check-circle me-2"></i>Riwayat Pesanan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="orderTabsContent">
                        <!-- Active Orders -->
                        <div class="tab-pane fade show active" id="active" role="tabpanel">
                            <div class="card-body">
                                @forelse($activeOrders as $order)
                                    <div class="card border-0 bg-light mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-box-seam text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-bold">{{ $order->order_number }}</h6>
                                                            <p class="text-muted mb-0">{{ $order->service->name }} • {{ $order->weight }} {{ $order->service->unit }}</p>
                                                        </div>
                                                        <span class="badge bg-{{ $order->status_color }} ms-auto">{{ $order->status_text }}</span>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <div class="d-flex justify-content-between mb-2">
                                                            <small class="text-muted">Progress</small>
                                                            <small class="fw-bold">{{ $order->progress_percentage }}%</small>
                                                        </div>
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-{{ $order->status_color }}" style="width: {{ $order->progress_percentage }}%"></div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="bi bi-calendar me-2"></i>
                                                        <small>Estimasi selesai: {{ $order->delivery_date->format('d M Y') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-md-end">
                                                    <div class="h4 text-primary mb-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                                    <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline-primary">
                                                        <i class="bi bi-eye me-1"></i>Detail Pesanan
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="bi bi-inbox display-1 text-muted mb-4"></i>
                                        <h5 class="text-muted mb-3">Tidak ada pesanan aktif</h5>
                                        <p class="text-muted mb-4">Buat pesanan pertama Anda sekarang dan nikmati layanan laundry terbaik!</p>
                                        <a href="{{ route('customer.orders.create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-plus me-2"></i>Pesan Sekarang
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Order History -->
                        <div class="tab-pane fade" id="history" role="tabpanel">
                            <div class="card-body">
                                @forelse($orderHistory as $order)
                                    <div class="card border-0 bg-light mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-check-circle text-success"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-bold">{{ $order->order_number }}</h6>
                                                            <p class="text-muted mb-0">{{ $order->service->name }} • {{ $order->weight }} {{ $order->service->unit }}</p>
                                                        </div>
                                                        <span class="badge bg-{{ $order->status_color }} ms-auto">{{ $order->status_text }}</span>
                                                    </div>
                                                    
                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="bi bi-calendar-check me-2"></i>
                                                        <small>Selesai: {{ $order->updated_at->format('d M Y') }}</small>
                                                        <div class="ms-3">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="bi bi-star{{ $i <= 5 ? '-fill text-warning' : ' text-muted' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-md-end">
                                                    <div class="h5 text-success mb-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                                    <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="bi bi-eye me-1"></i>Detail
                                                    </a>
                                                    <button class="btn btn-outline-warning btn-sm ms-1">
                                                        <i class="bi bi-arrow-repeat me-1"></i>Pesan Lagi
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="bi bi-clock-history display-1 text-muted mb-4"></i>
                                        <h5 class="text-muted mb-3">Belum ada riwayat pesanan</h5>
                                        <p class="text-muted">Riwayat pesanan yang sudah selesai akan muncul di sini</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        .nav-pills .nav-link {
            border-radius: 50px;
            padding: 10px 20px;
            margin-right: 10px;
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</x-app-layout>
