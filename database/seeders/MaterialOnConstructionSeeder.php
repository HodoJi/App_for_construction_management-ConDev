<?php

namespace Database\Seeders;

use App\Models\MaterialOnConstruction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialOnConstructionSeeder extends Seeder
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
                'material_id'       => 1,
                'construction_id'   => 1,
                'stock_count'       => 60,
            ],
            2 => [
                'material_id'       => 2,
                'construction_id'   => 1,
                'stock_count'       => 1000,
            ],
            3 => [
                'material_id'       => 3,
                'construction_id'   => 1,
                'stock_count'       => 22,
            ],
            4 => [
                'material_id'       => 4,
                'construction_id'   => 1,
                'stock_count'       => 12,
            ],
            5 => [
                'material_id'       => 5,
                'construction_id'   => 1,
                'stock_count'       => 120,
            ],
            6 => [
                'material_id'       => 6,
                'construction_id'   => 1,
                'stock_count'       => 44,
            ],
            7 => [
                'material_id'       => 7,
                'construction_id'   => 1,
                'stock_count'       => 60,
            ],
        ];

        foreach ($list as $id => $item_data)
        {
            $check = MaterialOnConstruction::find($id);

            if(!$check)
            {
                $_class = new MaterialOnConstruction();
                $_class->id = $id;
                $_class->construction_id = $item_data['construction_id'];
                $_class->material_id = $item_data['material_id'];
                $_class->stock_count = $item_data['stock_count'];
                $_class->timestamps = false;

                $_class->save();
            }
        }
    }
}
