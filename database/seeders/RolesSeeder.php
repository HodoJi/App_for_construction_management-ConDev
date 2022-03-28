<?php
/* → MAY BE ADDED IN FUTURE.

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    //*
    //* Run the database seeds.
    //*
    //* @return void
    //*
    public function run()
    {
        $roles = [
            1 => [
                'role' => 'admin'
            ]
        ];

        foreach ($roles as $id => $rolesData)
        {
            $role = Role::find($id);

            if (!$role)
            {
                $newRole = new Role();
                $newRole->id = $id;
                $newRole->role = $rolesData['role'];
                $newRole->save();
            }
        }
    }
}
*/
