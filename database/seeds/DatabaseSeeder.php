<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'roles', 'categories', 'admins', 'states', 'cities', 'leagues', 'membership_plans', 'businesses', 'businesses_users_roles', 'stores'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('AdminsTableSeeder');
        $this->call('StatesTableSeeder');
        $this->call('CitiesTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('LeaguesTableSeeder');
        $this->call('MembershipPlansTableSeeder');
        $this->call('BusinessesTableSeeder');
        $this->call('StoresTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
