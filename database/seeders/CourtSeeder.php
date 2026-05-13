<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Court::create([
            'name' => 'Lapangan A',
            'price_per_hour' => 100000,
            'description' => 'Lapangan indoor dengan rumput sintetis premium.',
        ]);
        \App\Models\Court::create([
            'name' => 'Lapangan B',
            'price_per_hour' => 100000,
            'description' => 'Lapangan standar internasional.',
        ]);
        \App\Models\Court::create([
            'name' => 'Lapangan C',
            'price_per_hour' => 120000,
            'description' => 'Lapangan eksklusif dengan fasilitas lengkap.',
        ]);
    }
}
