<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterBank;

class MasterBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        


        MasterBank::create(['nama_bank' => 'BRI', 'kategori' => 'BRI','logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/1e/Bank-Rakyat-Indonesia-Logo.svg']);
        MasterBank::create(['nama_bank' => 'BCA', 'kategori' => 'BCA','logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/799px-Bank_Central_Asia.svg.png']);
        MasterBank::create(['nama_bank' => 'Mandiri', 'kategori' => 'Mandiri','logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/640px-Bank_Mandiri_logo_2016.svg.png']);
        MasterBank::create(['nama_bank' => 'BNI', 'kategori' => 'BNI','logo_url' => 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/640px-BNI_logo.svg.png']);
    }
}
