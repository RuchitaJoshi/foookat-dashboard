<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->first();

        $user->admins()->attach(5, ['active' => 1]); // array of role id : Super Admin
    }
}
