<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'status' => 'Draft',
            ],
            [
                'status' => 'Diajukan',
            ],
            [
                'status' => 'Disetujui',
            ],
            [
                'status' => 'Dikerjakan',
            ],
            [
                'status' => 'Selesai',
            ],
            [
                'status' => 'Ditolak',
            ],
        ];

        foreach ($statuses as $data) {
            DB::table('statuses')->insert($data);
        }
    }
}