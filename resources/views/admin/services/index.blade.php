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
                                    <i class="bi bi-gear me-2 text-primary"></i>Manajemen Layanan
                                </h3>
                                <p class="text-muted mb-0">Kelola layanan dan harga laundry</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                    <i class="bi bi-plus me-1"></i>Tambah Layanan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-droplet text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="editService({{ $service->id }})">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </a></li>
                                        <li><a class="dropdown-item" href="#" onclick="toggleService({{ $service->id }})">
                                            <i class="bi bi-{{ $service->is_active ? 'eye-slash' : 'eye' }} me-2"></i>
                                            {{ $service->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteService({{ $service->id }})">
                                            <i class="bi bi-trash me-2"></i>Hapus
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <h5 class="fw-bold mb-2">{{ $service->name }}</h5>
                            <p class="text-muted mb-3">{{ $service->description }}</p>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small class="text-muted d-block">Harga</small>
                                        <strong class="text-primary">{{ $service->formatted_price }}</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small class="text-muted d-block">Unit</small>
                                        <strong>{{ $service->unit }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small class="text-muted d-block">Durasi</small>
                                        <strong>{{ $service->duration_hours }}h</strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small class="text-muted d-block">Status</small>
                                        <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm flex-fill" onclick="editService({{ $service->id }})">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="viewStats({{ $service->id }})">
                                    <i class="bi bi-bar-chart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Service Modal -->
        <div class="modal fade" id="addServiceModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Layanan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Unit</label>
                                    <select class="form-select" name="unit" required>
                                        <option value="kg">Kilogram (kg)</option>
                                        <option value="pcs">Pieces (pcs)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="price" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Durasi (Jam)</label>
                                    <input type="number" class="form-control" name="duration_hours" value="48" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        <label class="form-check-label">Aktifkan layanan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editService(serviceId) {
            // Implement edit functionality
            alert('Edit service ID: ' + serviceId);
        }

        function toggleService(serviceId) {
            if (confirm('Ubah status layanan ini?')) {
                // Implement toggle functionality
                alert('Toggle service ID: ' + serviceId);
            }
        }

        function deleteService(serviceId) {
            if (confirm('Hapus layanan ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Implement delete functionality
                alert('Delete service ID: ' + serviceId);
            }
        }

        function viewStats(serviceId) {
            // Implement stats view
            alert('View stats for service ID: ' + serviceId);
        }
    </script>
</x-app-layout>
