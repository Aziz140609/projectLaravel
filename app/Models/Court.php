<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable = [
        'name',
        'price_per_hour',
        'description',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Main::class, 'court_id');
    }
}
