<?php

namespace Database\Seeders;

use App\Models\Predicate;
use Illuminate\Database\Seeder;

class PredicateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Predicate::factory()->times(5)->create();
    }
}
