<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Booking - ArenaPlay</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #F3F4F6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .ticket-container { width: 100%; max-width: 450px; }
        .ticket { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; }
        
        /* Zigzag effect */
        .ticket::before, .ticket::after { content: ""; position: absolute; left: -10px; width: 20px; height: 20px; background-color: #F3F4F6; border-radius: 50%; }
        .ticket::before { top: 120px; }
        .ticket::after { right: -10px; left: auto; top: 120px; }
        
        .ticket-header { background: #4F46E5; color: white; padding: 30px 20px; text-align: center; border-bottom: 2px dashed rgba(255,255,255,0.3); }
        .ticket-title { margin: 0; font-size: 1.5rem; font-weight: 800; }
        .ticket-subtitle { margin: 5px 0 0; font-size: 0.9rem; opacity: 0.8; }
        
        .ticket-body { padding: 30px 24px; }
        .status-badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 20px; }
        .status-paid { background: #D1FAE5; color: #065F46; }
        .status-unpaid { background: #FEF3C7; color: #92400E; }
        
        .detail-group { margin-bottom: 16px; }
        .detail-label { font-size: 0.85rem; color: #6B7280; font-weight: 500; text-transform: uppercase; margin-bottom: 4px; }
        .detail-value { font-size: 1.1rem; color: #1F2937; font-weight: 700; }
        
        .ticket-footer { background: #F9FAFB; padding: 20px; text-align: center; border-top: 1px solid #E5E7EB; }
        .barcode { font-family: monospace; font-size: 1.2rem; letter-spacing: 5px; color: #1F2937; margin-bottom: 10px; }
        
        .btn-home { display: block; background: #4F46E5; color: white; text-decoration: none; text-align: center; padding: 14px; border-radius: 12px; font-weight: 600; margin-top: 20px; transition: background 0.3s; }
        .btn-home:hover { background: #4338CA; }
    </style>
</head>
<body>

    <div class="ticket-container">
        @if(session('success'))
            <div style="background-color: #10B981; color: white; padding: 12px; border-radius: 12px; text-align: center; font-weight: 600; margin-bottom: 20px;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="ticket">
            <div class="ticket-header">
                <h1 class="ticket-title">ArenaPlay Ticket</h1>
                <p class="ticket-subtitle">Bukti Pemesanan Lapangan</p>
            </div>
            <div class="ticket-body">
                <div style="text-align: center;">
                    @if($main->status_pembayaran == 'lunas')
                        <span class="status-badge status-paid"><i class="fa-solid fa-check"></i> LUNAS</span>
                    @else
                        <span class="status-badge status-unpaid"><i class="fa-solid fa-clock"></i> BELUM LUNAS (BAYAR DI TEMPAT)</span>
                    @endif
                </div>

                <div class="detail-group">
                    <div class="detail-label">Pemesan</div>
                    <div class="detail-value">{{ $main->nama_pemesan }}</div>
                </div>
                
                <div style="display: flex; justify-content: space-between;">
                    <div class="detail-group">
                        <div class="detail-label">Lapangan</div>
                        <div class="detail-value">Lap. {{ $main->nomor_lapangan }}</div>
                    </div>
                    <div class="detail-group" style="text-align: right;">
                        <div class="detail-label">Tanggal</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($main->tanggal_main)->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">Waktu Main</div>
                    <div class="detail-value" style="color: #4F46E5;">{{ substr($main->jam_mulai, 0, 5) }} - {{ substr($main->jam_selesai, 0, 5) }} WIB</div>
                </div>

                <div class="detail-group" style="margin-top: 24px; padding-top: 16px; border-top: 1px dashed #E5E7EB;">
                    <div class="detail-label">Total Harga</div>
                    <div class="detail-value" style="font-size: 1.5rem;">Rp {{ number_format($main->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="ticket-footer">
                <div class="barcode">|||| | || || | ||| |</div>
                <div style="font-size: 0.8rem; color: #6B7280;">BKG-{{ str_pad($main->id, 6, '0', STR_PAD_LEFT) }}</div>
                <p style="font-size: 0.8rem; margin-top: 10px; color: #9CA3AF;">Tunjukkan e-ticket ini kepada petugas lapangan.</p>
            </div>
        </div>

        <a href="{{ route('booking.index') }}" class="btn-home">Kembali ke Beranda</a>
    </div>

</body>
</html>
