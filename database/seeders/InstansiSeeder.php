<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instansi::unguard();
        DB::unprepared(file_get_contents(base_path('opd.sql')));
        // $this->command->info('Tabel Instansi telah ter-seed!');
    }
}