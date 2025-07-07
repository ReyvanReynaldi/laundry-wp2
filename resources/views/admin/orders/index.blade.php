<x-app-layout>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="mb-0 fw-bold">
                                    <i class="bi bi-box-seam me-2 text-primary"></i>Manajemen Pesanan
                                </h3>
                                <p class="text-muted mb-0">Kelola semua pesanan laundry</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                                        <i class="bi bi-funnel me-1"></i>Filter
                                    </button>
                                    <button class="btn btn-outline-success">
                                        <i class="bi bi-download me-1"></i>Ekspor
                                    </button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                                        <i class="bi bi-plus me-1"></i>Tambah Pesanan
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
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-clock text-warning"></i>
                        </div>
                        <h4 class="text-warning fw-bold">{{ $orders->where('status', 'pending')->count() }}</h4>
                        <p class="text-muted mb-0">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                            <i class="bi bi-arrow-clockwise text-info"></i>
                        </div>
                        <h4 class="text-info fw-bold">{{ $orders->where('status', 'processing')->count() }}</h4>
                        <p class="text-muted mb-0">Diproses</p>
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
                        <p class="text-muted mb-0">Siap</p>
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
        </div>

        <!-- Orders Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 fw-bold">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th class="border-0 fw-bold">ID Pesanan</th>
                                <th class="border-0 fw-bold">Pelanggan</th>
                                <th class="border-0 fw-bold">Layanan</th>
                                <th class="border-0 fw-bold">Status</th>
                                <th class="border-0 fw-bold">Penjemputan</th>
                                <th class="border-0 fw-bold">Pengantaran</th>
                                <th class="border-0 fw-bold">Total</th>
                                <th class="border-0 fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input order-checkbox" value="{{ $order->id }}">
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-primary">{{ $order->order_number }}</strong><br>
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
                                                <small class="text-muted">{{ $order->user->phone ?? 'Tidak ada telepon' }}</small>
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
                                        <div class="dropdown">
                                            <button class="btn btn-sm badge bg-{{ $order->status_color }} dropdown-toggle" 
                                                    data-bs-toggle="dropdown" style="border: none;">
                                                {{ $order->status_text }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'pending')">
                                                    <i class="bi bi-clock text-warning me-2"></i>Menunggu
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'processing')">
                                                    <i class="bi bi-arrow-clockwise text-info me-2"></i>Diproses
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'ready')">
                                                    <i class="bi bi-check-circle text-success me-2"></i>Siap
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'completed')">
                                                    <i class="bi bi-archive text-primary me-2"></i>Selesai
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="updateStatus({{ $order->id }}, 'cancelled')">
                                                    <i class="bi bi-x-circle me-2"></i>Batal
                                                </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $order->pickup_date->format('d M') }}</strong><br>
                                            <small class="text-muted">{{ $order->pickup_time }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $order->delivery_date->format('d M') }}</strong><br>
                                            <small class="text-muted">{{ $order->delivery_time }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-primary" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button class="btn btn-outline-success" onclick="printOrder({{ $order->id }})" title="Cetak">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                            <button class="btn btn-outline-info" onclick="sendNotification({{ $order->id }})" title="Notifikasi">
                                                <i class="bi bi-bell"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada pesanan</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select class="form-select form-select-sm me-2" style="width: auto;">
                                <option>Aksi Massal</option>
                                <option value="processing">Tandai Sedang Diproses</option>
                                <option value="ready">Tandai Siap</option>
                                <option value="completed">Tandai Selesai</option>
                                <option value="print">Cetak Terpilih</option>
                            </select>
                            <button class="btn btn-sm btn-outline-primary">Terapkan</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
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
                                    <option value="pending">Menunggu</option>
                                    <option value="processing">Diproses</option>
                                    <option value="ready">Siap</option>
                                    <option value="completed">Selesai</option>
                                    <option value="cancelled">Dibatalkan</option>
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
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Akhir</label>
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
        function updateStatus(orderId, status) {
            if (confirm('Perbarui status pesanan ini?')) {
                fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        function printOrder(orderId) {
            window.open(`/admin/orders/${orderId}/print`, '_blank');
        }

        function sendNotification(orderId) {
            alert('Notifikasi dikirim ke pelanggan');
        }

        // Select all checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</x-app-layout>
