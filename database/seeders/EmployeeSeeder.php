<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Carissa',                    // * Pimpinan
                'id_user' => 1,
                'jabatan' => 'CEO',
            ],
            [
                'nama' => 'Ani',                    // * User Teknisi
                'id_user' => 2,
                'jabatan' => 'Tata Usaha',
            ],
            [
                'nama' => 'Admin',                         // * Administrator
                'id_user' => 3,
                'jabatan' => 'TIK',
            ],
        ];

        foreach ($users as $user) {
            DB::table('employees')->insert($user);
        }
    }
}