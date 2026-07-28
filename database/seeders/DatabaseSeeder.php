<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesPermissionsDatabaseSeeder::class,
            UsersDatabaseSeeder::class,

            DepartemensDatabaseSeeder::class,
            PosisisDatabaseSeeder::class,
            PegawaisDatabaseSeeder::class,
            PenggajianDatabaseSeeder::class,
            PresensiDatabaseSeeder::class,
        ]);
    }
}
