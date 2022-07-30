<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminOpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_opds')->insert([
            'id_user' => 4,
            'nama' => 'Hendri',
            'instansi' => 'Dinas Sosial Provinsi Jawa Timur',
            'created_by' => 1,
        ]);
    }
}