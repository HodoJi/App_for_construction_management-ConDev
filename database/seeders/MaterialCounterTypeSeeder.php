<?php

namespace Database\Seeders;

use App\Models\MaterialCounterType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialCounterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            1 => [
                'material_counter_type' => 'ks',
            ],
            2 => [
                'material_counter_type' => 'kg',
            ],
        ];

        foreach ($list as $id => $item_data)
        {
            $check = MaterialCounterType::find($id);

            if(!$check)
            {
                $_class = new MaterialCounterType();
                $_class->material_counter_type_id = $id;
                $_class->material_counter_type = $item_data['material_counter_type'];
                $_class->timestamps = false;

                $_class->save();
            }
        }
    }
}
