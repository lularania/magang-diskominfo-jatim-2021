<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permohonans = [
            [
                'id_adminOPD' => 1,
                'id_kategori' => 1,
                'id_status' => 2,
                'judul' => 'Permohonan Hosting Dinas Sosial',
                'instansi' => 'Dinas Sosial Provinsi Jawa Timur',
                'deskripsi' => 'Hosting baru karena sebelumnya eror',
                // 'berkas' => 1,
                'created_by' => 3,
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($permohonans as $data) {
            DB::table('permohonans')->insert($data);
        }
    }
}