<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            1 => [ // Admin:r#1
                'name'  => 'Admin Doe',
                'email' => 'admindoe@stavenisko.test',
                'personalId' => '111222333',
                'role_id' => '1',
            ],
            2 => [ // Stavbyvedúci:r#2
                'name'  => 'Stavbyvedúci Doe',
                'email' => 'stavbyveducidoe@stavenisko.test',
                'personalId' => '222333111',
                'role_id' => '2',
            ],
            3 => [ // Robotník:r#3
                'name'  => 'Robotník Doe',
                'email' => 'robotnikdoe@stavenisko.test',
                'personalId' => '333222111',
                'role_id' => '3',
            ],
            4 => [ // Šofér:r#4
                'name'  => 'Šofér Doe',
                'email' => 'soferdoe@stavenisko.test',
                'personalId' => '444333222',
                'role_id' => '4',
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
