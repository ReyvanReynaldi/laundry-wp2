<x-app-layout>
    <div class="container-fluid py-4" style="background: #f8f9fa;">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-2 fw-bold">
                                    <i class="bi bi-speedometer2 me-3"></i>Dashboard Admin
                                </h2>
                                <p class="mb-0 opacity-75">Selamat datang, {{ auth()->user()->name }}! Kelola operasional laundry dengan efisien</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="d-flex justify-content-md-end gap-2">
                                    <button class="btn btn-light btn-sm">
                                        <i class="bi bi-bell me-1"></i>Notifikasi
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-gear me-1"></i>Pengaturan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Total Pesanan</h6>
                                <h2 class="mb-0 text-primary fw-bold">{{ $todayStats['total_orders'] }}</h2>
                                <small class="text-muted">Hari ini</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-box-seam text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i>+12%
                            </span>
                            <small class="text-muted ms-2">dari kemarin</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Selesai</h6>
                                <h2 class="mb-0 text-success fw-bold">{{ $todayStats['completed_orders'] }}</h2>
                                <small class="text-muted">Hari ini</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i>+8%
                            </span>
                            <small class="text-muted ms-2">dari kemarin</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Pending</h6>
                                <h2 class="mb-0 text-warning fw-bold">{{ $todayStats['pending_orders'] }}</h2>
                                <small class="text-muted">Perlu diproses</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-clock text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-exclamation-triangle me-1"></i>Urgent
                            </span>
                            <small class="text-muted ms-2">butuh perhatian</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Pendapatan</h6>
                                <h2 class="mb-0 text-info fw-bold">Rp {{ number_format($todayStats['revenue']/1000, 0) }}K</h2>
                                <small class="text-muted">Hari ini</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-currency-dollar text-info" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i>+15%
                            </span>
                            <small class="text-muted ms-2">dari kemarin</small>
                        </div>
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
                            <i class="bi bi-lightning me-2 text-warning"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-primary bg-opacity-10 h-100 hover-card">
                                        <div class="card-body text-center p-4">
                                            <i class="bi bi-plus-circle text-primary mb-3" style="font-size: 2.5rem;"></i>
                                            <h6 class="fw-bold text-primary">Kelola Pesanan</h6>
                                            <p class="text-muted small mb-0">Update status pesanan</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
                                    <div class="card border-0 bg-success bg-opacity-10 h-100 hover-card">
                                        <div class="card-body text-center p-4">
                                            <i class="bi bi-gear text-success mb-3" style="font-size: 2.5rem;"></i>
                                            <h6 class="fw-bold text-success">Kelola Layanan</h6>
                                            <p class="text-muted small mb-0">Atur harga & layanan</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 bg-info bg-opacity-10 h-100 hover-card">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-people text-info mb-3" style="font-size: 2.5rem;"></i>
                                        <h6 class="fw-bold text-info">Kelola Pelanggan</h6>
                                        <p class="text-muted small mb-0">Data pelanggan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 bg-warning bg-opacity-10 h-100 hover-card">
                                    <div class="card-body text-center p-4">
                                        <i class="bi bi-bar-chart text-warning mb-3" style="font-size: 2.5rem;"></i>
                                        <h6 class="fw-bold text-warning">Laporan</h6>
                                        <p class="text-muted small mb-0">Analisis bisnis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-clock-history me-2 text-primary"></i>Pesanan Terbaru
                            </h5>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 fw-bold">Pesanan</th>
                                        <th class="border-0 fw-bold">Pelanggan</th>
                                        <th class="border-0 fw-bold">Layanan</th>
                                        <th class="border-0 fw-bold">Status</th>
                                        <th class="border-0 fw-bold">Total</th>
                                        <th class="border-0 fw-bold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>{{ $order->order_number }}</strong><br>
                                                    <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                        <i class="bi bi-person text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $order->user->name }}</strong><br>
                                                        <small class="text-muted">{{ $order->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $order->service->name }}</strong><br>
                                                    <small class="text-muted">{{ $order->weight }} {{ $order->service->unit }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $order->status_color }} fs-6">
                                                    {{ $order->status_text }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <button class="btn btn-outline-success" onclick="updateStatus({{ $order->id }})">
                                                        <i class="bi bi-arrow-clockwise"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada pesanan</h5>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
        }
    </style>

    <script>
        function updateStatus(orderId) {
            alert('Update status untuk order ID: ' + orderId);
        }
    </script>
</x-app-layout>
