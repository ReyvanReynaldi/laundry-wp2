<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'LaundryPro') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-light">
  <div class="min-vh-100 d-flex flex-column">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                  <i class="bi bi-droplet-fill text-primary me-2 fs-4"></i>
                  <span class="fw-bold">LaundryPro</span>
              </a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav me-auto">
                      @auth
                          @if(auth()->user()->role === 'admin')
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                      <i class="bi bi-speedometer2 me-1"></i>Dasbor
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                      <i class="bi bi-box-seam me-1"></i>Kelola Pesanan
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('admin.services.index') }}">
                                      <i class="bi bi-gear me-1"></i>Kelola Layanan
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('admin.analytics') }}">
                                      <i class="bi bi-bar-chart me-1"></i>Analitik
                                  </a>
                              </li>
                          @else
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('customer.dashboard') }}">
                                      <i class="bi bi-house me-1"></i>Dasbor
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('customer.orders.create') }}">
                                      <i class="bi bi-plus-circle me-1"></i>Pesan Laundry
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('customer.orders.index') }}">
                                      <i class="bi bi-list-ul me-1"></i>Pesanan Saya
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('orders.track') }}">
                                      <i class="bi bi-search me-1"></i>Lacak Pesanan
                                  </a>
                              </li>
                          @endif
                      @endauth
                  </ul>

                  <ul class="navbar-nav">
                      @guest
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                          </li>
                      @else
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                  <i class="bi bi-person-circle me-1"></i>
                                  {{ auth()->user()->role === 'admin' ? 'Admin' : 'Pelanggan' }} {{ Auth::user()->name }}
                              </a>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                      <i class="bi bi-person me-2"></i>Profil
                                  </a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li>
                                      <form method="POST" action="{{ route('logout') }}">
                                          @csrf
                                          <button type="submit" class="dropdown-item">
                                              <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                          </button>
                                      </form>
                                  </li>
                              </ul>
                          </li>
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>

      <!-- Page Content -->
      <main class="flex-grow-1">
          @if(session('success'))
              <div class="container mt-3">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
              </div>
          @endif

          @if(session('error'))
              <div class="container mt-3">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
              </div>
          @endif

          {{ $slot }}
      </main>

      <!-- Footer -->
      <footer class="bg-dark text-light py-4 mt-5">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <div class="d-flex align-items-center mb-3">
                          <i class="bi bi-droplet-fill text-primary me-2 fs-4"></i>
                          <span class="fw-bold fs-5">LaundryPro</span>
                      </div>
                      <p class="text-muted">Layanan laundry terpercaya dengan teknologi modern dan pelayanan terbaik.</p>
                  </div>
                  <div class="col-md-3">
                      <h6 class="fw-bold mb-3">Layanan</h6>
                      <ul class="list-unstyled">
                          <li><a href="#" class="text-muted text-decoration-none">Cuci Kering</a></li>
                          <li><a href="#" class="text-muted text-decoration-none">Cuci Setrika</a></li>
                          <li><a href="#" class="text-muted text-decoration-none">Dry Clean</a></li>
                          <li><a href="#" class="text-muted text-decoration-none">Layanan Express</a></li>
                      </ul>
                  </div>
                  <div class="col-md-3">
                      <h6 class="fw-bold mb-3">Kontak</h6>
                      <ul class="list-unstyled text-muted">
                          <li><i class="bi bi-telephone me-2"></i>+62 812-3456-7890</li>
                          <li><i class="bi bi-envelope me-2"></i>info@laundrypro.com</li>
                          <li><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                      </ul>
                  </div>
              </div>
              <hr class="my-4">
              <div class="text-center text-muted">
                  <p>&copy; {{ date('Y') }} LaundryPro. Semua hak dilindungi.</p>
              </div>
          </div>
      </footer>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
