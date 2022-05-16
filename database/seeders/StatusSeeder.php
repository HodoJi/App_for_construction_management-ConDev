<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
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
                'status_name' => 'Nepriradená',
            ],
            2 => [
                'status_name' => 'Priradená',
            ],
            3 => [
                'status_name' => 'V preprave',
            ],
            4 => [
                'status_name' => 'Doručená',
            ],
        ];

        foreach ($list as $id => $item_data)
        {
            $check = DB::table("statuses")->find($id);

            if (!$check)
            {
                $_class = new Status();
                $_class->id = $id;
                $_class->status_name = $item_data['status_name'];
                $_class->timestamps = false;

                $_class->save();
            }
        }
    }
}

