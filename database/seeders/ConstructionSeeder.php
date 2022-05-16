<?php

namespace Database\Seeders;

use App\Models\Construction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constructions = [
            1 => [
                'title' => 'Bottova 5',
            ],
            2 => [
                'title' => 'Novozámocká 22',
            ],
            3 => [
                'title' => 'Tr. A. Hlinku 1',
            ],
            4 => [
                'title' => 'Považská 9',
            ],
            5 => [
                'title' => 'Golianova 18',
            ],
            6 => [
                'title' => 'Kmeťova 57',
            ],

        ];

        foreach ($constructions as $id => $constructionData)
        {
            $check = DB::table("constructions")->find($id);

            if (!$check)
            {
                $newConstruction = new Construction();
                $newConstruction->id = $id;
                $newConstruction->title = $constructionData['title'];

                $newConstruction->save();
            }
        }
    }
}
