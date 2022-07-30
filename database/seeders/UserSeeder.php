<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'id_role' => 1,                         // * Pimpinan
                'email' => 'rissa@gmail.com',
                'password' => Hash::make('rissa123'),
                'role' => 'pimpinan',
            ],
            [
                'id_role' => 2,                         // * User Teknisi
                'email' => 'ani@gmail.com',
                'password' => Hash::make('aniani123'),
                'role' => 'teknisi',
            ],
            [
                'id_role' => 3,                         // * Administrator
                'email' => 'admin@hoster.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'id_role' => 4,                         // * Admin OPD
                'email' => 'hendri@gmail.com',
                'password' => Hash::make('hendri123'),
                'role' => 'adminOpd',
            ],
            [
                'id_role' => 3,                         // * Administrator
                'email' => 'lula@hoster.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],
        ];

        foreach ($users as $data) {
            $user = User::create([
                'id_role' => $data['id_role'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            $user->assignRole($data['role']);
        }
    }
}