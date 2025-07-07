<x-app-layout>
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="mb-0 fw-bold">
                            <i class="bi bi-person me-2 text-primary"></i>Profil Saya
                        </h3>
                        <p class="text-muted mb-0">Kelola informasi akun dan preferensi Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Profile Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-person text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-1">{{ auth()->user()->name }}</h4>
                        <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                        
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="bg-light rounded p-2">
                                    <small class="text-muted d-block">Total Pesanan</small>
                                    <strong>24</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2">
                                    <small class="text-muted d-block">Poin Reward</small>
                                    <strong class="text-warning">1,250</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-camera me-1"></i>Ubah Foto
                            </button>
                            <button class="btn btn-outline-success">
                                <i class="bi bi-gift me-1"></i>Tukar Poin
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loyalty Program -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="mb-0 fw-bold">
                            <i class="bi bi-star me-2 text-warning"></i>Program Loyalitas
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-award text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="fw-bold">Gold Member</h6>
                            <small class="text-muted">Level 3 dari 5</small>
                        </div>
                        
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                        <small class="text-muted">750 poin lagi untuk Platinum</small>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Diskon Member</span>
                            <strong class="text-success">15%</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Poin per Rp 1000</span>
                            <strong class="text-primary">3 poin</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Forms -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="birth_date">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="address" rows="3">{{ auth()->user()->address }}</textarea>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check me-1"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Preferensi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Waktu Pickup Favorit</label>
                                <select class="form-select">
                                    <option>08:00 - 10:00</option>
                                    <option>10:00 - 12:00</option>
                                    <option>12:00 - 14:00</option>
                                    <option>14:00 - 16:00</option>
                                    <option>16:00 - 18:00</option>
                                    <option>18:00 - 20:00</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Layanan Favorit</label>
                                <select class="form-select">
                                    <option>Cuci Setrika</option>
                                    <option>Cuci Kering</option>
                                    <option>Dry Clean</option>
                                    <option>Express</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Catatan Khusus</label>
                                <textarea class="form-control" rows="2" placeholder="Instruksi khusus untuk setiap pesanan..."></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">Notifikasi</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                    <label class="form-check-label" for="emailNotif">
                                        Email Notifikasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="smsNotif" checked>
                                    <label class="form-check-label" for="smsNotif">
                                        SMS Notifikasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="promoNotif">
                                    <label class="form-check-label" for="promoNotif">
                                        Promo & Penawaran
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="reminderNotif" checked>
                                    <label class="form-check-label" for="reminderNotif">
                                        Reminder Pickup
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-primary">
                                <i class="bi bi-check me-1"></i>Simpan Preferensi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Security -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Keamanan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Password Saat Ini</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-shield-check me-1"></i>Update Password
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Two-Factor Authentication</h6>
                                <small class="text-muted">Tambahkan lapisan keamanan ekstra</small>
                            </div>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="bi bi-shield-plus me-1"></i>Aktifkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
