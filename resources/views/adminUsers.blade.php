<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manajemen User</title>
    
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

        /* --- Users Table --- */
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
        .role-badge { padding: 4px 10px; border-radius: 12px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; }
        .role-admin { background-color: #EEF2FF; color: #4F46E5; }
        .role-user { background-color: #F3F4F6; color: #6B7280; }
        
        .action-btns { display: flex; gap: 8px; }
        .btn-action { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition); }
        .btn-detail { background-color: #EFF6FF; color: #3B82F6; }
        .btn-times { background-color: #FEF2F2; color: #EF4444; }
        .btn-action:hover { transform: scale(1.05); }

        /* --- Pagination --- */
        .pagination-container { margin-top: 24px; display: flex; justify-content: flex-end; }
        .pagination { display: flex; list-style: none; gap: 8px; padding: 0; }
        .pagination li a, .pagination li span { padding: 8px 14px; border: 1px solid var(--border-color); border-radius: var(--radius-md); text-decoration: none; color: var(--text-main); background: var(--surface); transition: var(--transition); font-size: 0.9rem; }
        .pagination li.active span { background-color: var(--primary); color: white; border-color: var(--primary); }
        .pagination li a:hover { background-color: var(--bg-color); border-color: var(--text-muted); }

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
            <a href="{{ route('admin.users') }}" class="menu-item active"><i class="fa-solid fa-users"></i> User</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
            

        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <form action="{{ route('admin.users') }}" method="GET" class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari nama atau email user..." value="{{ request('search') }}">
                <button type="submit" style="display:none;"></button>
            </form>
            
            <div class="nav-actions">
                <button class="btn-icon">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="admin-profile">
                    <div class="admin-avatar">A</div>
                    <div class="admin-info">
                        <span class="admin-name">Admin</span>
                        <span class="admin-role">Super Admin</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="page-content">
            <div class="page-header">
                <h1 class="page-title">Manajemen User</h1>
            </div>

            @if(session('success'))
                <div style="background-color: #ECFDF5; color: #065F46; padding: 12px 16px; border-radius: var(--radius-md); margin-bottom: 16px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div style="background-color: #FEF2F2; color: #991B1B; padding: 12px 16px; border-radius: var(--radius-md); margin-bottom: 16px;">
                    <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
                </div>
            @endif

            <div class="table-card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Pengguna</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                            {{ $user->role ?? 'User' }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="#" class="btn-action btn-detail" title="Detail"><i class="fa-solid fa-eye"></i></a>
                                            
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.destroyUser', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-times" title="Hapus User" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 24px;">Tidak ada user ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="pagination-container">
                        {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
