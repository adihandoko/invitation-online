<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrewedPhotoCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'photo couple',
            'photo mempelai pria',
            'photo mempelai wanita',
            'photo 1',
            'photo 2',
            'photo 3',
            'photo 4'
        ];

        foreach ($categories as $category) {
            DB::table('prewed_photo_categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
