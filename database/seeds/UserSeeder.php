<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $default_password = Hash::make('parola12');

        $users = [
            ['name' => 'Delia', 'email' => 'delia@yahoo.com', 'role' => 'admin'],
            ['name' => 'Saga', 'email' => 'saga@example.com', 'role' => 'tester'],
            ['name' => 'Ana', 'email' => 'ana@example.com', 'role' => 'co-worker'],
        ];

        foreach($users as $single_user)
        {
            $check = User::where('email', $single_user['email'])->first();

            if($check === null)
            {
                $user = User::create([
                    'name' => $single_user['name'],
                    'email' => $single_user['email'],
                    'password' => $default_password,
                ]);

                $user->assignRole($single_user['role']);
            }
        }
    }
}
