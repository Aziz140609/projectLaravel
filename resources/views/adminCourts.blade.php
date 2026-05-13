<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lapangan - ArenaPlay</title>
    
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
        }

        /* --- Sidebar (Same as Dashboard) --- */
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

        .sidebar-logo span { color: var(--primary); }

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

        /* --- Main Content --- */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .page-content {
            padding: 32px;
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
        }

        .btn {
            padding: 10px 20px;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-primary { background-color: var(--primary); color: white; }
        .btn-primary:hover { background-color: var(--primary-hover); }

        .btn-danger { background-color: var(--danger); color: white; }
        .btn-warning { background-color: var(--warning); color: white; }

        /* --- Court Grid --- */
        .court-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .court-card {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .court-image {
            height: 180px;
            background-color: #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 3rem;
            position: relative;
        }

        .court-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .court-price-tag {
            position: absolute;
            top: 16px;
            right: 16px;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .court-info {
            padding: 20px;
            flex-grow: 1;
        }

        .court-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .court-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .court-schedule {
            margin-top: 16px;
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
        }

        .schedule-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .schedule-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .schedule-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background-color: #F9FAFB;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .schedule-time { font-weight: 600; color: var(--primary); }
        .schedule-user { color: var(--text-main); font-weight: 500; }

        .court-actions {
            padding: 16px 20px;
            background-color: #F9FAFB;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid var(--border-color);
        }

        .btn-action-sm {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-edit { background-color: #EEF2FF; color: var(--primary); }
        .btn-delete { background-color: #FEF2F2; color: var(--danger); }

        .btn-action-sm:hover { transform: scale(1.1); }

        /* --- Modal --- */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal.active { display: flex; }

        .modal-content {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 500px;
            padding: 32px;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            outline: none;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--text-muted);
        }

        .btn-ghost:hover {
            background-color: #F3F4F6;
            color: var(--text-main);
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
            <a href="{{ route('admin.courts') }}" class="menu-item active"><i class="fa-solid fa-futbol"></i> Lapangan</a>
            
            <div class="menu-label">Manajemen</div>
            <a href="{{ route('admin.users') }}" class="menu-item"><i class="fa-solid fa-users"></i> User</a>
            <a href="#" class="menu-item"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-navbar">
            <div style="font-weight: 600; color: var(--text-muted);">Admin / Lapangan</div>
            <div class="admin-profile" style="display: flex; align-items: center; gap: 12px;">
                <div style="text-align: right;">
                    <div style="font-weight: 600; font-size: 0.9rem;">Admin</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Super Admin</div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">A</div>
            </div>
        </header>

        <div class="page-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Manajemen Lapangan</h1>
                    <p style="color: var(--text-muted); margin-top: 4px;">Atur ketersediaan, harga, dan jadwal lapangan.</p>
                </div>
                <button class="btn btn-primary" onclick="openModal('addCourtModal')">
                    <i class="fa-solid fa-plus"></i> Tambah Lapangan
                </button>
            </div>

            @if(session('success'))
                <div style="background-color: #ECFDF5; color: #065F46; padding: 16px; border-radius: var(--radius-md); margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="court-grid">
                @forelse($courts as $court)
                    <div class="court-card">
                        <div class="court-image">
                            <i class="fa-solid fa-futbol"></i>
                            <div class="court-price-tag">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} / Jam</div>
                        </div>
                        <div class="court-info">
                            <h3 class="court-name">{{ $court->name }}</h3>
                            <p class="court-desc">{{ $court->description ?? 'Tidak ada deskripsi.' }}</p>
                            
                            <div class="court-schedule">
                                <div class="schedule-title">
                                    <i class="fa-solid fa-clock"></i> Jadwal Mendatang
                                </div>
                                <div class="schedule-list">
                                    @php
                                        $upcomingBookings = $court->bookings->where('tanggal_main', '>=', date('Y-m-d'))->take(3);
                                    @endphp
                                    @forelse($upcomingBookings as $booking)
                                        <div class="schedule-item">
                                            <span class="schedule-time">{{ date('d M', strtotime($booking->tanggal_main)) }} | {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }}</span>
                                            <span class="schedule-user">{{ $booking->nama_pemesan }}</span>
                                        </div>
                                    @empty
                                        <div style="font-size: 0.85rem; color: var(--text-muted); text-align: center; padding: 10px;">Tidak ada jadwal terdekat.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="court-actions">
                            <button class="btn-action-sm btn-edit" onclick="editCourt({{ $court->id }}, '{{ $court->name }}', {{ $court->price_per_hour }}, '{{ $court->description }}')" title="Edit Lapangan">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <form action="{{ route('admin.destroyCourt', $court->id) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-sm btn-delete" title="Hapus Lapangan">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px; background-color: var(--surface); border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
                        <i class="fa-solid fa-futbol" style="font-size: 3rem; color: var(--border-color); margin-bottom: 16px; display: block;"></i>
                        <h3 style="color: var(--text-muted);">Belum ada lapangan.</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Silakan tambah lapangan baru untuk memulai.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Add Court Modal -->
    <div id="addCourtModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Lapangan Baru</h2>
            </div>
            <form action="{{ route('admin.storeCourt') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Lapangan</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Lapangan A" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga per Jam (Rp)</label>
                    <input type="number" name="price_per_hour" class="form-control" placeholder="Contoh: 100000" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi (Opsional)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat lapangan..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="closeModal('addCourtModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Lapangan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Court Modal -->
    <div id="editCourtModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Lapangan</h2>
            </div>
            <form id="editCourtForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Lapangan</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga per Jam (Rp)</label>
                    <input type="number" name="price_per_hour" id="edit_price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi (Opsional)</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="closeModal('editCourtModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Lapangan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function editCourt(id, name, price, description) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_description').value = description;
            
            const form = document.getElementById('editCourtForm');
            form.action = `/admin/courts/${id}`;
            
            openModal('editCourtModal');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }
    </script>
</body>
</html>
