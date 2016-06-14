<?php

use App\MembershipPlan;
use Illuminate\Database\Seeder;

class MembershipPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership_plans = [
            [
                'name' => 'Basic',
                'details' => '1 Store, Unlimited Deals, Basic Reports',
                'amount' => 299
            ],
            [
                'name' => 'Advanced',
                'details' => '5 Stores, Unlimited Deals, Detailed Reports',
                'amount' => 499
            ],
            [
                'name' => 'Premium',
                'details' => '10 Stores, Unlimited Deals, Detailed Reports, Access to Customer Engagement, Foookat Promotions',
                'amount' => 999
            ],
            [
                'name' => 'Commission',
                'details' => 'Per deal commission'
            ]
        ];

        foreach ($membership_plans as $membership_plan)
        {
            MembershipPlan::create($membership_plan);
        }

    }
}
