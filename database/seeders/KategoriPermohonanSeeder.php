<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori_permohonans = [
            [
                'kategori' => 'Hosting Baru',
            ],
            [
                'kategori' => 'Domain Baru',
            ],
            [
                'kategori' => 'Revisi Nama Domain',
            ],
            [
                'kategori' => 'Tambah Storage',
            ],
            [
                'kategori' => 'Aduan Insiden Keamanan',
            ],
        ];

        foreach ($kategori_permohonans as $data) {
            DB::table('kategori_permohonans')->insert($data);
        }
    }
}