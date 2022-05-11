<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConstructionSeeder::class,
            MaterialCounterTypeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            MaterialSeeder::class,
            MaterialOnConstructionSeeder::class,
        ]);
    }
}
