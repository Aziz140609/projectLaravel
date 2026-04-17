<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaPlay - Pemesanan Lapangan Futsal</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<div id="Container-1">
    <div id="Navbar">
        <a href="/" class="logo">Arena<span>Play.</span></a>
        
        <div class="nav-links">
            <a href="#Container-1" class="nav-link">Beranda</a>
            <a href="#Container-2" class="nav-link">Keunggulan</a>
            <a href="#Container-3" class="nav-link">Booking</a>
        </div>
    </div>

    <div id="Hero">
        <div id="Hero-Left">
           <img id="GambarKiri1" src="{{ asset('img/pemain_1.jpg') }}" alt="Pemain Futsal Kiri" data-aos="fade-right" data-aos-delay="100">
           
           <img id="GambarKiri2" src="{{ asset('img/pemain_2.jpg') }}" alt="Pemain Futsal Utama" data-aos="zoom-in" data-aos-delay="400">
           
           <img id="GambarKiri3" src="{{ asset('img/pemain_3.jpg') }}" alt="Pemain Futsal Kanan" data-aos="fade-left" data-aos-delay="300">
        </div>

        <div id="Hero-Right">
             <h1 id="Judul" data-aos="fade-up">ArenaPlay</h1>
             <p id="Deskripsi" data-aos="fade-up" data-aos-delay="150">Tempat bermain futsal terbaik di kota. Fasilitas premium, lapangan berkualitas internasional, dan sistem pemesanan tercepat.</p>
             
             <div class="hero-buttons" data-aos="fade-up" data-aos-delay="300">
                 <a href="{{ route('booking.index') }}" class="btn-register" style="text-decoration: none;">Booking Sekarang</a>
             </div>
        </div>
    </div>
</div>

<div id="Container-2">
    <div id="Keunggulan">
        <h2 id="JudulKeunggulan" data-aos="fade-up">Keunggulan Kami</h2>
        <p id="DeskripsiKeunggulan" data-aos="fade-up" data-aos-delay="100">Mengapa memilih ArenaPlay sebagai tempat bermain futsal Anda?</p>

        <div id="CardContainer">
            <div class="card-1" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('img/lapangan.jpg') }}" alt="Lapangan Berkualitas">
                <h3>Tidak Terpengaruh Cuaca</h3>
                <p>Main futsal kapan saja, tanpa khawatir hujan atau panas. Lapangan indoor kami selalu nyaman untuk bermain.</p>
            </div>
            <div class="card-2" data-aos="fade-up" data-aos-delay="400">
                <img src="{{ asset('img/booking.jpg') }}" alt="Booking Mudah">
                <h3>Pencahayaan Optimal</h3>
                <p>Tetap terang siang maupun malam</p>
            </div>
            <div class="card-3" data-aos="fade-up" data-aos-delay="600">
                <img src="{{ asset('img/fasilitas.jpg') }}" alt="Fasilitas Lengkap">
                <h3>Cocok untuk Event</h3>
                <p>Tempat yang sempurna untuk mengadakan turnamen futsal, acara perusahaan, atau pertandingan persahabatan.</p>
            </div>
        </div>
    </div>

</div>

<div id="Container-3">
    <div id="JudulContainer-3">
        <h2>Tunggu Apa Lagi?</h2>
        <p>Booking lapangan futsal sekarang juga dan nikmati fasilitas terbaik di kota.</p>
    </div>

    <div id="ButtonContainer-3">
        <a href="{{ route('booking.index') }}" class="btn-register" style="display: inline-block; text-decoration: none;">Booking Sekarang</a>
    </div>
</div>

<div id="Container-4">

</div>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>