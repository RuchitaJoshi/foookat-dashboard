<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Rujul Trivedi',
                'email' => 'rujul04@gmail.com',
                'password' =>'password',
                'mobile_number' =>  '7043307711',
                'profile_picture' => 'http://i1.wp.com/www.techrepublic.com/bundles/techrepubliccore/images/icons/standard/icon-user-default.png',
                'active'    =>  TRUE,
                'remember_token' => null
            ],
            [
                'name' => 'Dhruv Vyas',
                'email' => 'dhruv.m.vyas@gmail.com',
                'password' => 'password',
                'mobile_number' =>  '7043307711',
                'profile_picture' => 'http://i1.wp.com/www.techrepublic.com/bundles/techrepubliccore/images/icons/standard/icon-user-default.png',
                'active'    =>  TRUE,
                'remember_token' => null
            ]
        ];

        foreach ($users as $user)
        {
            User::create($user);
        }

        factory('App\User',10)->create();
    }
}
