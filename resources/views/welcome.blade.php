<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaundryPro - Layanan Laundry Terpercaya</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .stats-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-droplet-fill text-primary me-2 fs-4"></i>
                <span class="fw-bold">LaundryPro</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="badge bg-light text-primary mb-3">
                        <i class="bi bi-star-fill me-1"></i>
                        Layanan Laundry Terpercaya #1
                    </div>
                    <h1 class="display-4 fw-bold mb-4">
                        Laundry Berkualitas<br>
                        <span class="text-warning">Dengan Teknologi Modern</span>
                    </h1>
                    <p class="lead mb-4">
                        Nikmati layanan laundry premium dengan pickup & delivery gratis, 
                        tracking real-time, dan jaminan kepuasan 100%.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        @auth
                            <a href="{{ route('customer.orders.create') }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-truck me-2"></i>Pesan Sekarang
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">
                                <i class="bi bi-truck me-2"></i>Pesan Sekarang
                            </a>
                        @endauth
                        <a href="{{ route('orders.track') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-search me-2"></i>Lacak Pesanan
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Laundry+Service" 
                         alt="Laundry Service" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light" id="services">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Mengapa Memilih LaundryPro?</h2>
                <p class="text-muted">Kami memberikan layanan terbaik dengan teknologi modern dan tim profesional</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm service-card">
                        <div class="card-body p-4">
                            <i class="bi bi-truck text-primary display-4 mb-3"></i>
                            <h5 class="card-title">Pickup & Delivery Gratis</h5>
                            <p class="card-text text-muted">
                                Layanan antar jemput gratis di seluruh area kota dengan jadwal yang fleksibel
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm service-card">
                        <div class="card-body p-4">
                            <i class="bi bi-clock text-success display-4 mb-3"></i>
                            <h5 class="card-title">Express 24 Jam</h5>
                            <p class="card-text text-muted">
                                Layanan express untuk kebutuhan mendesak dengan kualitas tetap terjaga
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm service-card">
                        <div class="card-body p-4">
                            <i class="bi bi-shield-check text-warning display-4 mb-3"></i>
                            <h5 class="card-title">Jaminan Kualitas</h5>
                            <p class="card-text text-muted">
                                Garansi 100% puas atau uang kembali dengan asuransi kerusakan pakaian
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services & Pricing Section -->
    <section class="py-5" id="pricing">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Layanan & Harga</h2>
                <p class="text-muted">Berbagai pilihan layanan untuk kebutuhan laundry Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-droplet text-primary display-5 mb-3"></i>
                            <h5 class="card-title">Cuci Kering</h5>
                            <p class="card-text text-muted small mb-3">Pakaian sehari-hari, bed cover, selimut</p>
                            <div class="h4 text-primary fw-bold">
                                Rp 6.000<small class="text-muted fs-6">/kg</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-stars text-warning display-5 mb-3"></i>
                            <h5 class="card-title">Cuci Setrika</h5>
                            <p class="card-text text-muted small mb-3">Pakaian rapi siap pakai</p>
                            <div class="h4 text-warning fw-bold">
                                Rp 8.000<small class="text-muted fs-6">/kg</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-gem text-success display-5 mb-3"></i>
                            <h5 class="card-title">Dry Clean</h5>
                            <p class="card-text text-muted small mb-3">Jas, gaun, pakaian premium</p>
                            <div class="h4 text-success fw-bold">
                                Rp 25.000<small class="text-muted fs-6">/pcs</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-lightning text-danger display-5 mb-3"></i>
                            <h5 class="card-title">Express</h5>
                            <p class="card-text text-muted small mb-3">Selesai dalam 24 jam</p>
                            <div class="h4 text-danger fw-bold">
                                Rp 12.000<small class="text-muted fs-6">/kg</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 stats-section text-white">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="h2 fw-bold mb-2">10,000+</div>
                    <p class="mb-0 opacity-75">Pelanggan Puas</p>
                </div>
                <div class="col-md-3">
                    <div class="h2 fw-bold mb-2">50,000+</div>
                    <p class="mb-0 opacity-75">Pesanan Selesai</p>
                </div>
                <div class="col-md-3">
                    <div class="h2 fw-bold mb-2">99.8%</div>
                    <p class="mb-0 opacity-75">Tingkat Kepuasan</p>
                </div>
                <div class="col-md-3">
                    <div class="h2 fw-bold mb-2">24/7</div>
                    <p class="mb-0 opacity-75">Customer Service</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Hubungi Kami</h2>
                <p class="text-muted">Siap melayani Anda 24/7</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-telephone text-primary display-5 mb-3"></i>
                            <h5 class="card-title">Telepon</h5>
                            <p class="card-text text-muted">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-envelope text-primary display-5 mb-3"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text text-muted">info@laundrypro.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="bi bi-geo-alt text-primary display-5 mb-3"></i>
                            <h5 class="card-title">Alamat</h5>
                            <p class="card-text text-muted">
                                Jl. Sudirman No. 123<br>
                                Jakarta Pusat
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
