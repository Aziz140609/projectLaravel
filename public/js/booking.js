function hitungHarga() {
    const mulai = document.getElementById('jam_mulai').value;
    const durasiMenit = parseInt(document.getElementById('durasi')?.value);
    
    if (!mulai || isNaN(durasiMenit)) {
        document.getElementById('total-box').style.display = 'none';
        document.getElementById('total_harga').value = 0;
        return;
    }
    
    const durasiJam = durasiMenit / 60;
    const pricePerHour = document.getElementById('price_per_hour').value || 100000;
    const total = durasiJam * pricePerHour;
    
    document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('total_harga').value = total;
    document.getElementById('total-box').style.display = 'flex';
}

function pilihPembayaran(metode) {
    document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));
    document.getElementById('card-' + metode).classList.add('active');
}
