<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Gateway Pembayaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #F9FAFB; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        .header { background: white; padding: 20px; text-align: center; border-bottom: 1px solid #E5E7EB; position: sticky; top: 0; z-index: 10; }
        .header-title { font-size: 1.2rem; font-weight: 700; color: #1F2937; margin: 0; }
        .container { padding: 24px; flex-grow: 1; }
        .summary-card { background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 24px; }
        .merchant-name { font-size: 1rem; color: #6B7280; font-weight: 500; margin-bottom: 8px; text-align: center; }
        .total-amount { font-size: 2.25rem; font-weight: 800; color: #1F2937; text-align: center; margin-bottom: 24px; }
        .detail-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px dashed #E5E7EB; font-size: 0.95rem; }
        .detail-row:last-child { border-bottom: none; padding-bottom: 0; }
        .detail-label { color: #6B7280; }
        .detail-value { font-weight: 600; color: #1F2937; }
        
        .methods-title { font-size: 1rem; font-weight: 700; color: #1F2937; margin-bottom: 16px; }
        .method-list { display: flex; flex-direction: column; gap: 12px; margin-bottom: 32px; }
        .method-card { background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 16px; cursor: pointer; transition: all 0.2s ease; }
        .method-card.selected { border-color: #4F46E5; background: #EEF2FF; box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2); }
        .method-icon { width: 40px; height: 40px; border-radius: 8px; background: #F3F4F6; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .method-name { font-weight: 600; color: #1F2937; flex-grow: 1; }
        .radio-btn { width: 20px; height: 20px; border-radius: 50%; border: 2px solid #D1D5DB; display: flex; align-items: center; justify-content: center; }
        .method-card.selected .radio-btn { border-color: #4F46E5; }
        .method-card.selected .radio-btn::after { content: ''; width: 10px; height: 10px; background: #4F46E5; border-radius: 50%; }
        
        .btn-pay { background: #4F46E5; color: white; border: none; width: 100%; padding: 16px; border-radius: 12px; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: background 0.2s ease; font-family: 'Outfit', sans-serif; display: flex; justify-content: center; align-items: center; gap: 8px; }
        .btn-pay:hover { background: #4338CA; }
        .btn-pay:disabled { background: #9CA3AF; cursor: not-allowed; }
        
        .success-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.95); z-index: 100; display: none; flex-direction: column; align-items: center; justify-content: center; }
        .success-icon { width: 80px; height: 80px; background: #10B981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 24px; animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .success-title { font-size: 1.5rem; font-weight: 800; color: #1F2937; margin-bottom: 8px; }
        .success-desc { color: #6B7280; text-align: center; padding: 0 24px; }
        @keyframes scaleIn { 0% { transform: scale(0); } 100% { transform: scale(1); } }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="header-title">Checkout Pembayaran</h1>
    </div>

    <div class="container">
        <div class="summary-card">
            <div class="merchant-name">ArenaPlay Booking</div>
            <div class="total-amount">Rp {{ number_format($main->total_harga, 0, ',', '.') }}</div>
            
            <div class="detail-row">
                <span class="detail-label">Order ID</span>
                <span class="detail-value">#BKG-{{ str_pad($main->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Lapangan</span>
                <span class="detail-value">{{ $main->court ? $main->court->name : 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Waktu</span>
                <span class="detail-value">{{ substr($main->jam_mulai, 0, 5) }} - {{ substr($main->jam_selesai, 0, 5) }}</span>
            </div>
        </div>

        <h2 class="methods-title">Pilih Metode Pembayaran</h2>
        
        <form id="paymentForm" action="{{ route('booking.process', $main->id) }}" method="POST">
            @csrf
            <div class="method-list">
                <div style="font-size: 0.9rem; color: #6B7280; font-weight: 600; margin-bottom: -4px;">E-Wallet</div>
                <div class="method-card selected" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #00AED6; background: #E0F7FA;"><i class="fa-solid fa-wallet"></i></div>
                    <div class="method-name">GoPay</div>
                    <div class="radio-btn"></div>
                </div>
                <div class="method-card" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #4C3494; background: #EDE7F6;"><i class="fa-solid fa-wallet"></i></div>
                    <div class="method-name">OVO</div>
                    <div class="radio-btn"></div>
                </div>
                <div class="method-card" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #118EEA; background: #E3F2FD;"><i class="fa-solid fa-wallet"></i></div>
                    <div class="method-name">DANA</div>
                    <div class="radio-btn"></div>
                </div>

                <div style="font-size: 0.9rem; color: #6B7280; font-weight: 600; margin-top: 8px; margin-bottom: -4px;">Virtual Account Bank</div>
                <div class="method-card" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #00529C; background: #E1F5FE;"><i class="fa-solid fa-building-columns"></i></div>
                    <div class="method-name">BRI Virtual Account</div>
                    <div class="radio-btn"></div>
                </div>
                <div class="method-card" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #0066AE; background: #E1F5FE;"><i class="fa-solid fa-building-columns"></i></div>
                    <div class="method-name">BCA Virtual Account</div>
                    <div class="radio-btn"></div>
                </div>
                <div class="method-card" onclick="selectMethod(this)">
                    <div class="method-icon" style="color: #F2A900; background: #FFF8E1;"><i class="fa-solid fa-building-columns"></i></div>
                    <div class="method-name">Mandiri Virtual Account</div>
                    <div class="radio-btn"></div>
                </div>
            </div>

            <button type="button" class="btn-pay" id="payButton" onclick="processPayment()">
                Bayar Sekarang
            </button>
        </form>
    </div>

    <div class="success-overlay" id="successOverlay">
        <div class="success-icon"><i class="fa-solid fa-check"></i></div>
        <div class="success-title">Pembayaran Berhasil!</div>
        <div class="success-desc">Terima kasih, pembayaran Anda telah kami terima. Anda bisa kembali ke halaman booking di device sebelumnya.</div>
    </div>

    <script>
        function selectMethod(element) {
            document.querySelectorAll('.method-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');
        }

        function processPayment() {
            const btn = document.getElementById('payButton');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            // Simulasi loading 1.5 detik
            setTimeout(() => {
                document.getElementById('successOverlay').style.display = 'flex';
                
                // Submit form ke backend untuk update status jadi lunas
                setTimeout(() => {
                    document.getElementById('paymentForm').submit();
                }, 1500);
            }, 1500);
        }
    </script>
</body>
</html>
