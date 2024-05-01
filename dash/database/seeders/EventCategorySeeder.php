<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat seeder untuk kategori acara
        EventCategory::create([
            'name' => 'Ulang Tahun'
        ]);

        EventCategory::create([
            'name' => 'Pernikahan'
        ]);

        // Tambahkan seeder lain jika diperlukan
    }
}
