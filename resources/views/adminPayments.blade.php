<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pembayaran</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --secondary: #10B981;
            --bg-color: #F3F4F6;
            --surface: #FFFFFF;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --danger: #EF4444;
            --warning: #F59E0B;
            --sidebar-width: 260px;
            --header-height: 70px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-main); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* --- Sidebar --- */
        .sidebar { width: var(--sidebar-width); background-color: var(--surface); border-right: 1px solid var(--border-color); position: fixed; top: 0; bottom: 0; left: 0; display: flex; flex-direction: column; z-index: 100; }
        .sidebar-header { height: var(--header-height); display: flex; align-items: center; padding: 0 24px; border-bottom: 1px solid var(--border-color); }
        .sidebar-logo { font-size: 1.5rem; font-weight: 800; color: var(--text-main); text-decoration: none; }
        .sidebar-logo span { color: var(--primary); }
        .sidebar-menu { padding: 20px 16px; flex-grow: 1; overflow-y: auto; }
        .menu-label { font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); margin: 16px 0 8px 8px; letter-spacing: 0.05em; }
        .menu-item { display: flex; align-items: center; padding: 12px 16px; color: var(--text-muted); text-decoration: none; border-radius: var(--radius-md); margin-bottom: 4px; font-weight: 500; transition: var(--transition); }
        .menu-item i { width: 24px; font-size: 1.1rem; margin-right: 12px; text-align: center; }
        .menu-item:hover { background-color: #F9FAFB; color: var(--primary); }
        .menu-item.active { background-color: var(--primary); color: white; }

        /* --- Main Content Area --- */
        .main-content { flex: 1; margin-left: var(--sidebar-width); display: flex; flex-direction: column; min-height: 100vh; }

        /* --- Header / Navbar --- */
        .top-navbar { height: var(--header-height); background-color: var(--surface); border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 90; }
        .search-bar { display: flex; align-items: center; background-color: var(--bg-color); border-radius: 20px; padding: 8px 16px; width: 300px; border: 1px solid transparent; transition: var(--transition); }
        .search-bar:focus-within { border-color: var(--primary); background-color: var(--surface); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .search-bar i { color: var(--text-muted); margin-right: 8px; }
        .search-bar input { border: none; background: transparent; outline: none; width: 100%; font-size: 0.9rem; color: var(--text-main); }
        .nav-actions { display: flex; align-items: center; gap: 24px; }
        .btn-icon { background: transparent; border: none; color: var(--text-muted); font-size: 1.2rem; cursor: pointer; position: relative; transition: var(--transition); }
        .btn-icon:hover { color: var(--primary); }
        .badge { position: absolute; top: -6px; right: -6px; background-color: var(--danger); color: white; font-size: 0.65rem; font-weight: bold; padding: 2px 6px; border-radius: 10px; border: 2px solid var(--surface); }
        .admin-profile { display: flex; align-items: center; gap: 12px; cursor: pointer; }
        .admin-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .admin-info { display: flex; flex-direction: column; }
        .admin-name { font-weight: 600; font-size: 0.95rem; }
        .admin-role { font-size: 0.75rem; color: var(--text-muted); }

        /* --- Page Content --- */
        .page-content { padding: 32px; flex-grow: 1; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 1.5rem; font-weight: 700; color: var(--text-main); }
        .date-filter { display: flex; align-items: center; gap: 12px; background-color: var(--surface); padding: 8px 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color); font-size: 0.9rem; color: var(--text-muted); cursor: pointer; }

        /* --- Tabs --- */
        .tabs-container { display: flex; gap: 12px; margin-bottom: 24px; }
        .tab-item { padding: 10px 20px; border-radius: var(--radius-md); text-decoration: none; color: var(--text-muted); font-weight: 600; background: var(--surface); border: 1px solid var(--border-color); transition: var(--transition); font-size: 0.9rem; }
        .tab-item:hover { color: var(--primary); background: #F9FAFB; }
        .tab-item.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* --- Table Card --- */
        .table-card { background-color: var(--surface); border-radius: var(--radius-lg); padding: 24px; box-shadow: var(--shadow-sm); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--text-main); }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 16px; font-size: 0.85rem; font-weight: 600; color: var(--text-muted); border-bottom: 1px solid var(--border-color); }
        td { padding: 16px; border-bottom: 1px solid var(--border-color); font-size: 0.95rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .user-cell { display: flex; align-items: center; gap: 12px; font-weight: 500; }
        .avatar-sm { width: 32px; height: 32px; border-radius: 50%; background-color: var(--bg-color); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; color: var(--text-main); }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; display: inline-block; }
        .status-paid { background-color: #D1FAE5; color: #065F46; }
        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .action-btns { display: flex; gap: 8px; }
        .btn-action { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition); text-decoration: none; }
        .btn-check { background-color: #ECFDF5; color: #10B981; }
        .btn-times { background-color: #FEF2F2; color: #EF4444; }
        .btn-action:hover { transform: scale(1.05); }

        /* --- Pagination --- */
        .pagination-container { margin-top: 24px; display: flex; justify-content: flex-end; }
        .pagination { display: flex; list-style: none; gap: 8px; padding: 0; }
        .pagination li a, .pagination li span { padding: 8px 14px; border: 1px solid var(--border-color); border-radius: var(--radius-md); text-decoration: none; color: var(--text-main); background: var(--surface); transition: var(--transition); font-size: 0.9rem; }
        .pagination li.active span { background-color: var(--primary); color: white; border-color: var(--primary); }
        .pagination li a:hover { background-color: var(--bg-color); border-color: var(--text-muted); }
        .pagination li.disabled span { color: var(--text-muted); background-color: var(--bg-color); cursor: not-allowed; border-color: var(--border-color); }
        .pagination li.active span:hover { background-color: var(--primary); border-color: var(--primary); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="{{ route('admin.bookings') }}" class="menu-item"><i class="fa-solid fa-calendar-check"></i> Booking</a>
            <a href="{{ route('admin.courts') }}" class="menu-item"><i class="fa-solid fa-futbol"></i> Lapangan</a>
            
            <div class="menu-label">Manajemen</div>
            <a href="{{ route('admin.users') }}" class="menu-item"><i class="fa-solid fa-users"></i> User</a>
            <a href="{{ route('admin.payments') }}" class="menu-item active"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <form action="{{ route('admin.payments') }}" method="GET" class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari pemesan, lapangan..." value="{{ request('search') }}">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <button type="submit" style="display:none;"></button>
            </form>
            
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
                <h1 class="page-title">Manajemen Pembayaran</h1>
                <div class="date-filter">
                    <i class="fa-regular fa-calendar"></i>
                    Hari ini: {{ \Carbon\Carbon::now()->format('d M Y') }}
                </div>
            </div>

            <!-- Tabs Filter -->
            <div class="tabs-container">
                <a href="{{ route('admin.payments', ['search' => request('search')]) }}" class="tab-item {{ is_null($status) ? 'active' : '' }}">Semua</a>
                <a href="{{ route('admin.payments', ['status' => 'belum_lunas', 'search' => request('search')]) }}" class="tab-item {{ $status === 'belum_lunas' ? 'active' : '' }}">Belum Lunas</a>
                <a href="{{ route('admin.payments', ['status' => 'lunas', 'search' => request('search')]) }}" class="tab-item {{ $status === 'lunas' ? 'active' : '' }}">Lunas</a>
            </div>

            <!-- Table Card -->
            <div class="table-card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Status Pembayaran</h2>
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
                                <th>Tanggal & Jam Sesi</th>
                                <th>Total Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar-sm">
                                                {{ strtoupper(substr(optional($booking->user)->name ?? 'G', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight: 600;">{{ optional($booking->user)->name ?? 'Guest' }}</div>
                                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $booking->no_telepon }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $booking->court ? $booking->court->name : 'N/A' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->tanggal_main)->format('d M Y') }}<br>
                                        <span style="color: var(--text-muted); font-size: 0.85rem;">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</span>
                                    </td>
                                    <td style="font-weight: 600; color: var(--primary);">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($booking->status_pembayaran == 'lunas')
                                            <span class="status-badge status-paid"><i class="fa-solid fa-check"></i> Lunas</span>
                                        @else
                                            <span class="status-badge status-pending"><i class="fa-solid fa-clock"></i> Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            @if($booking->status_pembayaran != 'lunas')
                                                <form action="{{ route('admin.confirmPayment', $booking->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-check" title="Verifikasi Lunas" onclick="return confirm('Konfirmasi pembayaran lunas untuk booking ini?')">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: var(--secondary); font-size: 0.9rem; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Terverifikasi</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 24px;">Belum ada data pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="pagination-container">
                        {{ $bookings->appends(['status' => request('status'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
