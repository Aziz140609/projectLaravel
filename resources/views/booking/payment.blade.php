<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking - ArenaPlay</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #F3F4F6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .payment-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); text-align: center; max-width: 400px; width: 100%; }
        .title { font-size: 1.5rem; font-weight: 700; color: #1F2937; margin-bottom: 8px; }
        .subtitle { color: #6B7280; font-size: 0.95rem; margin-bottom: 24px; }
        .price { font-size: 2rem; font-weight: 800; color: #4F46E5; margin-bottom: 24px; }
        .qr-container { background: #F9FAFB; padding: 20px; border-radius: 16px; display: inline-block; margin-bottom: 24px; border: 1px dashed #E5E7EB; }
        .qr-image { width: 200px; height: 200px; }
        .instruction { color: #4B5563; font-size: 0.9rem; line-height: 1.5; margin-bottom: 24px; }
        .loader { border: 3px solid #F3F4F6; border-top: 3px solid #4F46E5; border-radius: 50%; width: 20px; height: 20px; animation: spin 1s linear infinite; display: inline-block; vertical-align: middle; margin-right: 8px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .waiting-text { color: #6B7280; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; justify-content: center; }
        .btn-cancel { margin-top: 20px; color: #EF4444; text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-block; }
    </style>
</head>
<body>

    <div class="payment-card">
        <h1 class="title">Pembayaran via QRIS</h1>
        <p class="subtitle">Scan QR Code dengan aplikasi pembayaran Anda</p>
        
        <div class="price">Rp {{ number_format($main->total_harga, 0, ',', '.') }}</div>
        
        <div class="qr-container">
            @php
                $paymentUrl = route('booking.gateway', $main->id);
                $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($paymentUrl);
            @endphp
            <img src="{{ $qrUrl }}" alt="QR Code Pembayaran" class="qr-image">
        </div>
        
        <p class="instruction">
            Buka aplikasi DANA, OVO, Gopay, atau Mobile Banking, lalu scan QR Code di atas. 
            <br><br>
            <strong>Simulasi:</strong> Scan dengan kamera HP Anda untuk mencoba!
        </p>
        
        <div class="waiting-text">
            <span class="loader"></span> Menunggu pembayaran...
        </div>

        <a href="{{ route('booking.index') }}" class="btn-cancel">Batalkan Booking</a>
    </div>

    <script>
        // Polling status pembayaran setiap 3 detik
        setInterval(function() {
            fetch(`/booking/check-status/{{ $main->id }}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'lunas') {
                        window.location.href = `/booking/proof/{{ $main->id }}`;
                    }
                });
        }, 3000);
    </script>
</body>
</html>
