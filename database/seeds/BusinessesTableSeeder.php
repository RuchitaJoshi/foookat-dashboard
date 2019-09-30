<?php

use App\Business;
use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $business = Business::create([
            'name' => 'Foookat Online Services',
            'address' => '36 Earth Bunglows, Corporate Road, Prahlad Nagar',
            'city' => 'Ahmedabad',
            'state' => 'Gujarat',
            'zip_code' => 380015,
            'type' => 'Services',
            'logo' => 'https://s3.ap-south-1.amazonaws.com/foookat-app/foookat-orange.png',
            'city_id' => 1,
            'membership_plan_id' => 1,
            'active' => 1,
            'approved' => 'Approved'
        ]);

        $business->users()->attach(2, ['role_id' => 1, 'active' => 1]);
    }
}
