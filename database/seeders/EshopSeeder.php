<?php

namespace Database\Seeders;

use App\Models\Eshop;
use Illuminate\Database\Seeder;

class EshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eshop::factory()->times(5)->create();
    }
}
