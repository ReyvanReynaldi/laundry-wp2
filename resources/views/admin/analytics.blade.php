<x-app-layout>
    <div class="container-fluid py-4" style="background: #f8f9fa;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-2 fw-bold">
                                    <i class="bi bi-graph-up me-3"></i>Analytics Dashboard
                                </h2>
                                <p class="mb-0 opacity-75">Real-time business performance dan insights</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="d-flex justify-content-md-end gap-2">
                                    <span class="badge bg-light text-dark px-3 py-2">
                                        <i class="bi bi-clock me-1"></i>
                                        <span id="last-updated">{{ now()->format('H:i:s') }}</span>
                                    </span>
                                    <button class="btn btn-outline-light btn-sm" onclick="refreshData()">
                                        <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Revenue Hari Ini</h6>
                                <h2 class="mb-0 text-success fw-bold" id="today-revenue">
                                    Rp {{ number_format($analytics['revenue']['today'], 0, ',', '.') }}
                                </h2>
                                <small class="text-muted">Target: Rp 500,000</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-currency-dollar text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: {{ min(($analytics['revenue']['today']/500000)*100, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Total Pesanan</h6>
                                <h2 class="mb-0 text-primary fw-bold" id="total-orders">
                                    {{ $analytics['orders']['today_orders'] }}
                                </h2>
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
                                <i class="bi bi-arrow-up me-1"></i>+{{ $analytics['growth']['order_growth'] }}%
                            </span>
                            <small class="text-muted ms-2">vs bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Pelanggan Aktif</h6>
                                <h2 class="mb-0 text-info fw-bold" id="active-customers">
                                    {{ $analytics['customers']['active_customers'] }}
                                </h2>
                                <small class="text-muted">Bulan ini</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-people text-info" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i>+{{ $analytics['growth']['customer_growth'] }}%
                            </span>
                            <small class="text-muted ms-2">vs bulan lalu</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted mb-2 fw-bold">Pending Orders</h6>
                                <h2 class="mb-0 text-warning fw-bold" id="pending-orders">
                                    {{ $analytics['orders']['pending_orders'] }}
                                </h2>
                                <small class="text-muted">Perlu diproses</small>
                            </div>
                            <div class="col-auto">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="bi bi-clock text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if($analytics['orders']['pending_orders'] > 5)
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-exclamation-triangle me-1"></i>High Priority
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle me-1"></i>Normal
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <!-- Revenue Chart -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-graph-up me-2 text-success"></i>Revenue Trend (30 Hari)
                            </h5>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary active">30D</button>
                                <button class="btn btn-outline-primary">7D</button>
                                <button class="btn btn-outline-primary">24H</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Order Status Distribution -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-pie-chart me-2 text-primary"></i>Status Pesanan
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" height="300"></canvas>
                        <div class="mt-3">
                            @foreach($analytics['status_distribution'] as $status)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-{{ $status->status === 'completed' ? 'success' : ($status->status === 'pending' ? 'warning' : 'info') }}">
                                        {{ ucfirst($status->status) }}
                                    </span>
                                    <strong>{{ $status->count }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Performance & Hourly Orders -->
        <div class="row g-4 mb-4">
            <!-- Service Performance -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-gear me-2 text-info"></i>Performa Layanan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Orders</th>
                                        <th>Revenue</th>
                                        <th>Avg/Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($analytics['services'] as $service)
                                        <tr>
                                            <td>
                                                <strong>{{ $service['name'] }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $service['orders_count'] }}</span>
                                            </td>
                                            <td>
                                                <strong class="text-success">Rp {{ number_format($service['revenue'], 0, ',', '.') }}</strong>
                                            </td>
                                            <td>
                                                Rp {{ number_format($service['orders_count'] > 0 ? $service['revenue']/$service['orders_count'] : 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hourly Orders -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-clock-history me-2 text-warning"></i>Pesanan per Jam (Hari Ini)
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="hourlyChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Customers & Peak Hours -->
        <div class="row g-4">
            <!-- Top Customers -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-trophy me-2 text-warning"></i>Top Customers
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($analytics['top_customers'] as $customer)
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $customer->name }}</h6>
                                    <small class="text-muted">{{ $customer->orders_count }} orders</small>
                                </div>
                                <div class="text-end">
                                    <strong class="text-success">Rp {{ number_format($customer->orders_sum_total_amount ?? 0, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Peak Hours -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-graph-up-arrow me-2 text-danger"></i>Peak Hours (7 Hari Terakhir)
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($analytics['peak_hours'] as $index => $hour)
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-{{ $index === 0 ? 'danger' : ($index === 1 ? 'warning' : 'info') }} bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-clock text-{{ $index === 0 ? 'danger' : ($index === 1 ? 'warning' : 'info') }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ sprintf('%02d:00 - %02d:00', $hour->hour, $hour->hour + 1) }}</h6>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-{{ $index === 0 ? 'danger' : ($index === 1 ? 'warning' : 'info') }}" 
                                             style="width: {{ ($hour->orders / $analytics['peak_hours']->first()->orders) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <strong>{{ $hour->orders }} orders</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($analytics['daily_revenue']->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('M d'); })) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($analytics['daily_revenue']->pluck('revenue')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Orders',
                    data: {!! json_encode($analytics['daily_revenue']->pluck('orders')) !!},
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.4,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($analytics['status_distribution']->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($analytics['status_distribution']->pluck('count')) !!},
                    backgroundColor: [
                        '#28a745',
                        '#ffc107', 
                        '#17a2b8',
                        '#6c757d',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Hourly Chart
        const hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
        const hourlyLabels = Array.from({length: 24}, (_, i) => i + ':00');
        const hourlyData = Array(24).fill(0);
        
        @foreach($analytics['hourly_orders'] as $hour)
            hourlyData[{{ $hour->hour }}] = {{ $hour->orders }};
        @endforeach

        const hourlyChart = new Chart(hourlyCtx, {
            type: 'bar',
            data: {
                labels: hourlyLabels,
                datasets: [{
                    label: 'Orders',
                    data: hourlyData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Real-time updates
        function refreshData() {
            fetch('/admin/analytics/realtime')
                .then(response => response.json())
                .then(data => {
                    // Update metrics
                    document.getElementById('today-revenue').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.revenue.today);
                    document.getElementById('total-orders').textContent = data.orders.today_orders;
                    document.getElementById('active-customers').textContent = data.customers.active_customers;
                    document.getElementById('pending-orders').textContent = data.orders.pending_orders;
                    document.getElementById('last-updated').textContent = new Date().toLocaleTimeString();
                    
                    console.log('Data refreshed at:', new Date().toLocaleTimeString());
                })
                .catch(error => console.error('Error refreshing data:', error));
        }

        // Auto refresh every 30 seconds
        setInterval(refreshData, 30000);
    </script>
</x-app-layout>
