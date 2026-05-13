<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArenaPlay - Form Booking</title>
    <link href="{{ asset('css/booking.css') }}" rel="stylesheet">
</head>
<body>

    <div class="form-card">
        <div class="form-header">
            <a href="{{ route('booking.index') }}">← Kembali pilih lapangan</a>
            <h1>Form Booking</h1>
            <span class="court-badge">{{ $court->name }}</span>
        </div>

        <form action="{{ route('booking.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="court_id" value="{{ $court->id }}">
            <input type="hidden" id="price_per_hour" value="{{ $court->price_per_hour }}">

            <div class="form-group">
                <label for="nama">Nama Pemesan</label>
                <input type="text" id="nama" name="nama_pemesan" class="form-control" placeholder="Masukkan nama lengkap" required>
                @error('nama_pemesan') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="telepon">No. HP / WhatsApp</label>
                <input type="text" id="telepon" name="no_telepon" class="form-control" placeholder="Contoh: 08123456789" required>
                @error('no_telepon') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Main</label>
                <input type="date" id="tanggal" name="tanggal_main" class="form-control" min="{{ date('Y-m-d') }}" required>
                @error('tanggal_main') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" required onchange="hitungHarga()">
                    @error('jam_mulai') <span class="error-text">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" required onchange="hitungHarga()">
                    @error('jam_selesai') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Total Harga -->
            <div class="total-box" id="total-box" style="display:none;">
                <span class="total-label">Estimasi Total</span>
                <span class="total-harga" id="total-display">Rp 0</span>
            </div>
            <input type="hidden" name="total_harga" id="total_harga" value="0">

            <!-- Metode Pembayaran -->
            <div class="form-group" style="margin-top: 10px;">
                <label>Metode Pembayaran</label>
                <div class="payment-options">
                    <label class="payment-card active" id="card-tempat" onclick="pilihPembayaran('tempat')">
                        <input type="radio" name="metode_pembayaran" value="tempat" checked hidden>
                        <div class="payment-icon">🏪</div>
                        <div class="payment-info">
                            <span class="payment-title">Bayar di Tempat</span>
                            <span class="payment-desc">Bayar tunai saat tiba di lapangan</span>
                        </div>
                        <div class="payment-check">✓</div>
                    </label>

                    <label class="payment-card" id="card-qr" onclick="pilihPembayaran('qr')">
                        <input type="radio" name="metode_pembayaran" value="qr" hidden>
                        <div class="payment-icon">📱</div>
                        <div class="payment-info">
                            <span class="payment-title">Bayar via QR Code</span>
                            <span class="payment-desc">Scan QR & bayar sekarang</span>
                        </div>
                        <div class="payment-check">✓</div>
                    </label>
                </div>
            </div>

            <!-- Panel QR Code (Dihapus karena akan muncul di halaman selanjutnya) -->
            
            <button type="submit" class="btn-submit">Konfirmasi Booking</button>
        </form>
    </div>

</body>

<script src="{{ asset('js/booking.js') }}"></script>
</html>