<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            1 => [
                'name'  => 'Admin Doe',
                'email' => 'admindoe@stavenisko.test',
                'password' => '0',
                'personalId' => '111222333',
                'role_id' => '1'
            ],
            2 => [
                'name'  => 'Manager Doe',
                'email' => 'managerdoe@stavenisko.test',
                'password' => '0',
                'personalId' => '333222111',
                'role_id' => '2'
            ],
            3 => [
                'name'  => 'Worker Doe',
                'email' => 'workerdoe@stavenisko.test',
                'password' => '0',
                'personalId' => '111333222',
                'role_id' => '3'
            ],

        ];

        foreach ($users as $id => $userData)
        {
            $user = User::find($id);

            if(!$user)
            {
                $newUser = new User();
                $newUser->id = $id;
                $newUser->name = $userData['name'];
                $newUser->email = $userData['email'];
                $newUser->personalId = $userData['personalId'];
                $newUser->role_id = $userData['role_id'];

                $newUser->save();
            }
        }
    }
}
