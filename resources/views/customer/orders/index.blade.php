<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="mb-0 fw-bold">
                                    <i class="bi bi-list-ul me-2 text-primary"></i>Pesanan Saya
                                </h3>
                                <p class="text-muted mb-0">Kelola dan pantau semua pesanan laundry Anda</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                                        <i class="bi bi-funnel me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('customer.orders.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus me-1"></i>Pesan Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-clock text-warning"></i>
                        </div>
                        <h4 class="text-warning fw-bold">{{ $orders->whereIn('status', ['pending', 'processing'])->count() }}</h4>
                        <p class="text-muted mb-0">Dalam Proses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                        <h4 class="text-success fw-bold">{{ $orders->where('status', 'ready')->count() }}</h4>
                        <p class="text-muted mb-0">Siap Diambil</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-archive text-primary"></i>
                        </div>
                        <h4 class="text-primary fw-bold">{{ $orders->where('status', 'completed')->count() }}</h4>
                        <p class="text-muted mb-0">Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-currency-dollar text-info"></i>
                        </div>
                        <h4 class="text-info fw-bold">Rp {{ number_format($orders->where('status', 'completed')->sum('total_amount'), 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0">Total Belanja</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div class="row">
            @forelse($orders as $order)
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <!-- Order Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-box-seam text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 fw-bold">{{ $order->order_number }}</h5>
                                                    <p class="text-muted mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                                <span class="badge bg-{{ $order->status_color }} fs-6">{{ $order->status_text }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Order Details -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-4">
                                            <div class="bg-light rounded p-2">
                                                <small class="text-muted d-block">Layanan</small>
                                                <strong>{{ $order->service->name }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bg-light rounded p-2">
                                                <small class="text-muted d-block">Berat/Jumlah</small>
                                                <strong>{{ $order->weight }} {{ $order->service->unit }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="bg-light rounded p-2">
                                                <small class="text-muted d-block">Estimasi Selesai</small>
                                                <strong>{{ $order->delivery_date->format('d M Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="text-muted">Progress</small>
                                                <small class="fw-bold">{{ $order->progress_percentage }}%</small>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-{{ $order->status_color }}" style="width: {{ $order->progress_percentage }}%"></div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                        @if($order->status === 'completed')
                                            <button class="btn btn-outline-warning btn-sm" onclick="reorder({{ $order->id }})">
                                                <i class="bi bi-arrow-repeat me-1"></i>Pesan Lagi
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" onclick="rateOrder({{ $order->id }})">
                                                <i class="bi bi-star me-1"></i>Beri Rating
                                            </button>
                                        @endif
                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <button class="btn btn-outline-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                                                <i class="bi bi-x-circle me-1"></i>Batalkan
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4 text-md-end">
                                    <div class="h3 text-success mb-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    
                                    @if($order->status === 'ready')
                                        <div class="alert alert-success mb-3">
                                            <i class="bi bi-check-circle me-2"></i>
                                            <strong>Siap diambil!</strong><br>
                                            <small>Pesanan Anda sudah selesai dan siap untuk delivery</small>
                                        </div>
                                    @endif

                                    <div class="text-muted">
                                        <small>
                                            <i class="bi bi-truck me-1"></i>
                                            Pickup: {{ $order->pickup_date->format('d M') }} • {{ $order->pickup_time }}<br>
                                            <i class="bi bi-house me-1"></i>
                                            Delivery: {{ $order->delivery_date->format('d M') }} • {{ $order->delivery_time }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted mb-4"></i>
                            <h4 class="text-muted mb-3">Belum ada pesanan</h4>
                            <p class="text-muted mb-4">Buat pesanan pertama Anda dan nikmati layanan laundry terbaik!</p>
                            <a href="{{ route('customer.orders.create') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-plus me-2"></i>Buat Pesanan Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="ready">Ready</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Layanan</label>
                                <select class="form-select">
                                    <option value="">Semua Layanan</option>
                                    <option value="cuci-kering">Cuci Kering</option>
                                    <option value="cuci-setrika">Cuci Setrika</option>
                                    <option value="dry-clean">Dry Clean</option>
                                    <option value="express">Express</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                    <button type="button" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function reorder(orderId) {
            if (confirm('Pesan ulang dengan detail yang sama?')) {
                // Implement reorder functionality
                window.location.href = '/customer/orders/create?reorder=' + orderId;
            }
        }

        function rateOrder(orderId) {
            // Implement rating functionality
            alert('Rate order ID: ' + orderId);
        }

        function cancelOrder(orderId) {
            if (confirm('Batalkan pesanan ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Implement cancel functionality
                alert('Cancel order ID: ' + orderId);
            }
        }
    </script>
</x-app-layout>
