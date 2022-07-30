<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'pimpinan',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teknisi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'adminOpd',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}