<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'name' => 'Business Owner', 'description' => 'Business Owner'],
            [ 'name' => 'Business Admin', 'description' => 'Business Admin'],
            [ 'name' => 'Store Admin', 'description' => 'Store Admin'],
            [ 'name' => 'System Admin', 'description' => 'System Admin'],
            [ 'name' => 'Super Admin', 'description' => 'Super Admin']
        ];

        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }
}
