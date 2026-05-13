<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaPlay - Booking Lapangan Futsal</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <a href="/" class="logo">Arena<span>Play.</span></a>
        <div class="nav-user">
            @auth
                <span class="user-name">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-booking" style="padding: 8px 20px; font-size: 0.9rem;">Login</a>
            @endauth
        </div>
    </nav>

    <div class="dashboard-container">
        <h1 class="section-title">Pilih Lapangan</h1>

        <div class="court-grid">
            @forelse($courts as $court)
                <div class="court-card">
                    <img src="{{ $court->image ? asset('storage/'.$court->image) : asset('img/lapangan.jpg') }}" alt="{{ $court->name }}" class="court-image">
                    <div class="court-info">
                        <h2>{{ $court->name }}</h2>
                        <p class="court-price">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} / jam</p>
                        <span class="court-status status-available">Tersedia</span>
                        <a href="{{ route('booking.form') }}?court_id={{ $court->id }}" class="btn-booking">Booking Sekarang</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666;">
                    <p>Maaf, belum ada lapangan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>