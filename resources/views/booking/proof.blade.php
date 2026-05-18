<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pemesanan - ArenaPlay</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .receipt-container { width: 100%; max-width: 400px; }
        .receipt { background: white; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); overflow: hidden; }
        
        .receipt-header { text-align: center; padding: 24px 20px; border-bottom: 2px dashed #E5E7EB; background-color: #ffffff; }
        .receipt-logo { font-size: 1.5rem; font-weight: 800; color: #4F46E5; margin-bottom: 4px; }
        .receipt-title { font-size: 1.1rem; color: #374151; font-weight: 600; margin: 0; }
        
        .receipt-body { padding: 24px 20px; background-color: #ffffff; }
        
        .status-badge { display: block; text-align: center; padding: 8px; border-radius: 6px; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; margin-bottom: 24px; }
        .status-paid { background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; }
        .status-unpaid { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
        
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.9rem; }
        .detail-label { color: #6B7280; }
        .detail-value { color: #111827; font-weight: 500; text-align: right; }
        
        .divider { border-top: 1px dashed #E5E7EB; margin: 16px 0; }
        
        .total-row { display: flex; justify-content: space-between; align-items: center; font-size: 1.1rem; font-weight: 700; color: #111827; margin-top: 16px; }
        
        .receipt-footer { padding: 20px; text-align: center; background-color: #F9FAFB; border-top: 1px solid #E5E7EB; }
        .receipt-id { font-size: 0.85rem; color: #6B7280; font-family: monospace; letter-spacing: 1px; }
        .thank-you { font-size: 0.85rem; color: #6B7280; margin-top: 8px; }
        
        .btn-home { display: block; background: #4F46E5; color: white; text-decoration: none; text-align: center; padding: 14px; border-radius: 8px; font-weight: 600; margin-top: 20px; transition: background 0.3s; }
        .btn-home:hover { background: #4338CA; }
    </style>
</head>
<body>

    <div class="receipt-container">
        @if(session('success'))
            <div style="background-color: #10B981; color: white; padding: 12px; border-radius: 8px; text-align: center; font-weight: 600; margin-bottom: 20px; font-size: 0.9rem;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="receipt">
            <div class="receipt-header">
                <div class="receipt-logo">ArenaPlay<span style="color: #10B981;">.</span></div>
                <h1 class="receipt-title">Nota Pemesanan</h1>
            </div>
            
            <div class="receipt-body">
                @if($main->status_pembayaran == 'lunas')
                    <div class="status-badge status-paid"><i class="fa-solid fa-check-circle"></i> LUNAS</div>
                @else
                    <div class="status-badge status-unpaid"><i class="fa-solid fa-clock"></i> BELUM LUNAS (Bayar di Tempat)</div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">No. Transaksi</span>
                    <span class="detail-value">TRX-{{ str_pad($main->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Waktu Order</span>
                    <span class="detail-value">{{ $main->created_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="divider"></div>

                <div class="detail-row">
                    <span class="detail-label">Nama Pemesan</span>
                    <span class="detail-value">{{ $main->nama_pemesan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">No. HP</span>
                    <span class="detail-value">{{ $main->no_telepon }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Lapangan</span>
                    <span class="detail-value">Lap. {{ $main->nomor_lapangan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Jadwal Main</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($main->tanggal_main)->format('d M Y') }}<br>{{ substr($main->jam_mulai, 0, 5) }} - {{ substr($main->jam_selesai, 0, 5) }} WIB</span>
                </div>

                <div class="divider"></div>

                <div class="total-row">
                    <span>Total Pembayaran</span>
                    <span style="color: #4F46E5;">Rp {{ number_format($main->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="receipt-footer">
                <div class="receipt-id">ID: BKG-{{ str_pad($main->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div class="thank-you">Terima kasih telah menggunakan layanan ArenaPlay.<br>Tunjukkan nota ini kepada admin / petugas.</div>
            </div>
        </div>

        <a href="{{ route('booking.index') }}" class="btn-home">Kembali ke Beranda</a>
    </div>

</body>
</html>
