<?php

namespace Database\Seeders;

use App\Models\CourierService;
use Illuminate\Database\Seeder;

class CourierServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourierService::factory()->times(5)->create();
    }
}
