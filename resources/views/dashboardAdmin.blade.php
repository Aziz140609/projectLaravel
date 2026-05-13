<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ArenaPlay</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #4F46E5; /* Indigo 600 */
            --primary-hover: #4338CA;
            --secondary: #10B981; /* Emerald 500 */
            --bg-color: #F3F4F6; /* Gray 100 */
            --surface: #FFFFFF;
            --text-main: #1F2937; /* Gray 800 */
            --text-muted: #6B7280; /* Gray 500 */
            --border-color: #E5E7EB; /* Gray 200 */
            --danger: #EF4444; /* Red 500 */
            --warning: #F59E0B; /* Amber 500 */
            --sidebar-width: 260px;
            --header-height: 70px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--surface);
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
        }

        .sidebar-logo span {
            color: var(--primary);
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--text-muted);
            margin: 16px 0 8px 8px;
            letter-spacing: 0.05em;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 4px;
            font-weight: 500;
            transition: var(--transition);
        }

        .menu-item i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
            text-align: center;
        }

        .menu-item:hover {
            background-color: #F9FAFB;
            color: var(--primary);
        }

        .menu-item.active {
            background-color: var(--primary);
            color: white;
        }

        /* --- Main Content Area --- */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- Header / Navbar --- */
        .top-navbar {
            height: var(--header-height);
            background-color: var(--surface);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--bg-color);
            border-radius: 20px;
            padding: 8px 16px;
            width: 300px;
        }

        .search-bar i {
            color: var(--text-muted);
            margin-right: 8px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .btn-icon {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.2rem;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
        }

        .btn-icon:hover {
            color: var(--primary);
        }

        .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: var(--danger);
            color: white;
            font-size: 0.65rem;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 10px;
            border: 2px solid var(--surface);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .admin-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* --- Page Content --- */
        .page-content {
            padding: 32px;
            flex-grow: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .date-filter {
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: var(--surface);
            padding: 8px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* --- Stats Grid --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--border-color);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
        }

        .icon-blue { background-color: #EFF6FF; color: #3B82F6; }
        .icon-green { background-color: #ECFDF5; color: #10B981; }
        .icon-purple { background-color: #F5F3FF; color: #8B5CF6; }
        .icon-orange { background-color: #FFF7ED; color: #F97316; }
        .icon-red { background-color: #FEF2F2; color: #EF4444; }
        .icon-indigo { background-color: #EEF2FF; color: #4F46E5; }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
        }

        /* --- Charts Row --- */
        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .chart-card {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .btn-outline {
            padding: 6px 12px;
            border: 1px solid var(--border-color);
            background: transparent;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .btn-outline:hover {
            background-color: var(--bg-color);
            color: var(--text-main);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* --- Recent Bookings Table --- */
        .table-card {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 16px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--text-main);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-paid {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-detail { background-color: #EFF6FF; color: #3B82F6; }
        .btn-check { background-color: #ECFDF5; color: #10B981; }
        .btn-times { background-color: #FEF2F2; color: #EF4444; }

        .btn-action:hover {
            transform: scale(1.05);
        }

        /* --- Responsive --- */
        @media (max-width: 1024px) {
            .charts-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-logo">Arena<span>Play.</span></a>
        </div>
        <div class="sidebar-menu">
            <div class="menu-label">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item active"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('admin.bookings') }}" class="menu-item"><i class="fa-solid fa-calendar-check"></i> Booking</a>
            <a href="{{ route('admin.courts') }}" class="menu-item"><i class="fa-solid fa-futbol"></i> Lapangan</a>
            
            <div class="menu-label">Manajemen</div>
            <a href="{{ route('admin.users') }}" class="menu-item"><i class="fa-solid fa-users"></i> User</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
            
            <div class="menu-label">Sistem</div>
            <a href="#" class="menu-item"><i class="fa-solid fa-chart-pie"></i> Laporan</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-gear"></i> Setting</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Cari booking, user, lapangan...">
            </div>
            
            <div class="nav-actions">
                <button class="btn-icon">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="admin-profile">
                    <div class="admin-avatar">
                        A
                    </div>
                    <div class="admin-info">
                        <span class="admin-name">Admin</span>
                        <span class="admin-role">Super Admin</span>
                    </div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; color: var(--text-muted);"></i>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="page-content">
            <div class="page-header">
                <h1 class="page-title">Dashboard Overview</h1>
                <div class="date-filter">
                    <i class="fa-regular fa-calendar"></i>
                    Hari ini: {{ \Carbon\Carbon::now()->format('d M Y') }}
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem;"></i>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <!-- Stat Card 1 -->
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total User</span>
                        <span class="stat-value">{{ number_format($totalUser, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Booking</span>
                        <span class="stat-value">{{ number_format($totalBooking, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="stat-card">
                    <div class="stat-icon icon-orange">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Booking Hari Ini</span>
                        <span class="stat-value">{{ number_format($bookingHariIni, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-check-to-slot"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Lapangan Tersedia</span>
                        <span class="stat-value">{{ $lapanganTersedia }}</span>
                    </div>
                </div>

                <!-- Stat Card 5 -->
                <div class="stat-card">
                    <div class="stat-icon icon-indigo">
                        <i class="fa-solid fa-rupiah-sign"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Pendapatan Bulan Ini</span>
                        <span class="stat-value">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Stat Card 6 -->
                <div class="stat-card">
                    <div class="stat-icon icon-red">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Jadwal Aktif</span>
                        <span class="stat-value">{{ number_format($jadwalAktif, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <!-- Chart: Pendapatan -->
                <div class="chart-card">
                    <div class="card-header">
                        <h2 class="card-title">Grafik Pendapatan (Mingguan)</h2>
                        <button class="btn-outline">Lihat Detail</button>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Chart: Lapangan Favorit -->
                <div class="chart-card">
                    <div class="card-header">
                        <h2 class="card-title">Lapangan Terpopuler</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="popularCourtChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="table-card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Booking</h2>
                </div>
                
                @if(session('success'))
                    <div style="background-color: #ECFDF5; color: #065F46; padding: 12px 16px; border-radius: var(--radius-md); margin-bottom: 16px;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Lapangan</th>
                                <th>Tanggal & Jam</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar-sm">
                                                {{ strtoupper(substr(optional($booking->user)->name ?? 'G', 0, 2)) }}
                                            </div>
                                            {{ optional($booking->user)->name ?? 'Guest' }}
                                        </div>
                                    </td>
                                    <td>Lapangan {{ $booking->nomor_lapangan }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->tanggal_main)->format('d M Y') }}<br>
                                        <span style="color: var(--text-muted); font-size: 0.85rem;">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                                    </td>
                                    <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($booking->status_pembayaran == 'lunas')
                                            <span class="status-badge status-paid">Lunas</span>
                                        @else
                                            <span class="status-badge status-pending">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <!-- Detail Button (Mata) -->
                                            <a href="#" class="btn-action btn-detail" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                            
                                            <!-- Check Button (Konfirmasi Lunas) -->
                                            @if($booking->status_pembayaran != 'lunas')
                                                <form action="{{ route('admin.confirmPayment', $booking->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-check" title="Verifikasi Lunas" onclick="return confirm('Konfirmasi pembayaran lunas untuk booking ini?')">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <!-- Delete Button (Silang) -->
                                            <form action="{{ route('admin.destroyBooking', $booking->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-times" title="Batalkan/Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada data booking.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Chart.js Scripts -->
    <script>
        // Revenue Chart (Line Chart)
        const ctxRev = document.getElementById('revenueChart').getContext('2d');
        const gradientBlue = ctxRev.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(79, 70, 229, 0.2)');
        gradientBlue.addColorStop(1, 'rgba(79, 70, 229, 0)');

        new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueLabels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($revenueData) !!},
                    borderColor: '#4F46E5',
                    backgroundColor: gradientBlue,
                    borderWidth: 3,
                    pointBackgroundColor: '#FFFFFF',
                    pointBorderColor: '#4F46E5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#E5E7EB' },
                        border: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        border: { display: false }
                    }
                }
            }
        });

        // Popular Court Chart (Doughnut Chart)
        const ctxCourt = document.getElementById('popularCourtChart').getContext('2d');
        new Chart(ctxCourt, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($courtLabels) !!},
                datasets: [{
                    data: {!! json_encode($courtData) !!},
                    backgroundColor: {!! json_encode($bgColors) !!},
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { family: "'Outfit', sans-serif" }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
