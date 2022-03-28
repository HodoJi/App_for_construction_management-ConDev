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
                'name'  => 'admin',
                'email' => 'admin@admin.test',
                'password' => 'admin'
                //, 'role_id' => '1'
            ]
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
                $newUser->password = Hash::make($userData['password']);

                //$newUser->role_id = $userData['role_id']; // MAY BE ADDED IN FUTURE.

                $newUser->save();
            }
        }
    }
}
