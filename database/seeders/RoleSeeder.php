<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
                'role_name' => 'Admin',
            ],
            2 => [
                'role_name' => 'Stavbyvedúci',
            ],

            3 => [
                'role_name' => 'Robotník',
            ],
            4 => [
                'role_name' => 'Šofér',
            ],
        ];

        foreach ($list as $id => $item_data)
        {
            $check = DB::table("roles")->find($id);

            if (!$check)
            {
                $_class = new Role();
                $_class->id = $id;
                $_class->role_name = $item_data['role_name'];
                $_class->timestamps = false;

                $_class->save();
            }
        }
    }
}
