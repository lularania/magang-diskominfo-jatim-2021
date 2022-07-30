<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('storage:link');

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            AdministratorSeeder::class,
            UserPimpinanSeeder::class,
            AdminOpdSeeder::class,
            KategoriPermohonanSeeder::class,
            StatusSeeder::class,
            PermohonanSeeder::class,
            UserTeknisiSeeder::class,
            InstansiSeeder::class,
        ]);
    }
}