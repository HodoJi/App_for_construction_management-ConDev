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
                'status_name' => 'Not Assigned',
            ],
            2 => [
                'status_name' => 'Assigned',
            ],
            3 => [
                'status_name' => 'In Delivery',
            ],
            4 => [
                'status_name' => 'Delivered',
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

