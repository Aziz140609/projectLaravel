function hitungHarga() {
    const mulai = document.getElementById('jam_mulai').value;
    const selesai = document.getElementById('jam_selesai').value;
    if (!mulai || !selesai) return;
    const [h1, m1] = mulai.split(':').map(Number);
    const [h2, m2] = selesai.split(':').map(Number);
    const durasi = ((h2 * 60 + m2) - (h1 * 60 + m1)) / 60;
    if (durasi <= 0) {
        document.getElementById('total-box').style.display = 'none';
        document.getElementById('total_harga').value = 0;
        return;
    }
    const pricePerHour = document.getElementById('price_per_hour').value || 100000;
    const total = durasi * pricePerHour;
    document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('total_harga').value = total;
    document.getElementById('total-box').style.display = 'flex';
}

function pilihPembayaran(metode) {
    document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));
    document.getElementById('card-' + metode).classList.add('active');
}
