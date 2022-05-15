<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
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
                'material_idf'              => 'drevo',
                'material_title'            => 'Drevo',
                'material_counter_type_id'  => 1,
            ],
            2 => [
                'material_idf'              => 'zelezo',
                'material_title'            => 'Železo',
                'material_counter_type_id'  => 2,
            ],
            3 => [
                'material_idf'              => 'cement',
                'material_title'            => 'Cement',
                'material_counter_type_id'  => 2,
            ],
            4 => [
                'material_idf'              => 'malta',
                'material_title'            => 'Malta',
                'material_counter_type_id'  => 2,
            ],
            5 => [
                'material_idf'              => 'tehla',
                'material_title'            => 'Tehla',
                'material_counter_type_id'  => 1,
            ],
            6 => [
                'material_idf'              => 'kvader',
                'material_title'            => 'Kváder',
                'material_counter_type_id'  => 1,
            ],
            7 => [
                'material_idf'              => 'sadrokarton',
                'material_title'            => 'Sádrokartón',
                'material_counter_type_id'  => 1,
            ],


            8 => [
                'material_idf'              => 'strk',
                'material_title'            => 'Štrk',
                'material_counter_type_id'  => 2,
            ],
            9 => [
                'material_idf'              => 'izolacia',
                'material_title'            => 'Izolácia',
                'material_counter_type_id'  => 1,
            ],
            10 => [
                'material_idf'              => 'silikon',
                'material_title'            => 'Silikón',
                'material_counter_type_id'  => 1,
            ],


        ];

        foreach ($list as $id => $item_data)
        {
            $check = Material::find($id);

            if(!$check)
            {
                $_class = new Material();
                $_class->material_id = $id;
                $_class->material_idf = $item_data['material_idf'];
                $_class->material_title = $item_data['material_title'];
                $_class->material_counter_type_id = $item_data['material_counter_type_id'];
                $_class->timestamps = false;

                $_class->save();
            }
        }
    }
}
