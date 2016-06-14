<?php

use App\Business;
use App\MembershipPlan;
use App\Role;
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
        $role = Role::where('name', '=', 'Business Owner')->firstOrFail();

        $membershipPlan = MembershipPlan::where('name', '=', 'Basic')->firstOrFail();

        $business = Business::create(['name' => 'Foookat Online Services',
            'address' => '36 Earth Bunglows, Corporate Road, Prahlad Nagar',
            'city' => 'Ahmedabad',
            'state' => 'Gujarat',
            'zip_code' => 380015,
            'type' => 'Services',
            'active' => 1,
            'approved' => 'Approved'
        ]);

        $business->users()->attach(2, ['role_id' => $role->id, 'active' => 1]);

        $business->membershipPlan()->attach($membershipPlan->id);
    }
}
