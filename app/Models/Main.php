<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'mains';

    protected $fillable = [
        'nama_pemesan',
        'no_telepon',
        'tanggal_main',
        'jam_mulai',
        'jam_selesai',
        'nomor_lapangan',
        'status_pembayaran',
        'total_harga',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
