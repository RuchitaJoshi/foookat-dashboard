<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BusinessRepository {

    /**
     * Get all businesses
     *
     * @return mixed
     */
    public  function  getBusinesses()
    {
        $businesses = DB::table('businesses as b')
            ->leftjoin('businesses_users_roles as bur', 'b.id', '=', 'bur.business_id')
            ->leftjoin('roles as r',function($query) {
                $query->on('bur.role_id', '=', 'r.id')
                    ->where('r.name', '=', 'Business Owner');
            })
            ->leftjoin('users as u', 'bur.user_id', '=', 'u.id')
            ->orderBy('b.created_at', 'desc')
            ->select('b.id', 'b.name', 'b.address', 'b.city', 'b.state', 'b.zip_code', 'b.type', 'b.active', 'b.status', 'b.created_at', 'b.deleted_at', 'u.name as owner_name')
            ->paginate(10);

        return $businesses;
    }

    /**
     * Get business
     *
     * @param $id
     * @return mixed
     */
    public  function  getBusiness($id)
    {
        $business = DB::table('businesses as b')
            ->leftjoin('businesses_users_roles as bur', 'b.id', '=', 'bur.business_id')
            ->leftjoin('roles as r',function($query) {
                $query->on('bur.role_id', '=', 'r.id')
                    ->where('r.name', '=', 'Business Owner');
            })
            ->leftjoin('businesses_plans as bp', 'b.id', '=', 'bp.business_id')
            ->leftjoin('membership_plans as mp',function($query) {
                $query->on('bp.membership_plan_id', '=', 'mp.id');
            })
            ->leftjoin('users as u', 'bur.user_id', '=', 'u.id')
            ->where('b.id', '=', $id)
            ->select('b.id', 'b.name', 'b.address', 'b.city', 'b.state', 'b.zip_code', 'b.type', 'b.active', 'b.status', 'b.created_at', 'b.deleted_at', 'mp.name as membership_plan', 'u.name as owner_name', 'u.email as owner_email', 'u.mobile_number as owner_mobile_number', 'u.active as owner_active', 'u.deleted_at as owner_deleted_at')
            ->first();

        return $business;
    }

    /**
     * Get membership plan of a business
     *
     * @param $business_id
     * @return mixed
     */
    public  function  getMembershipPlan($business_id)
    {
        $membership_plan = DB::table('businesses_plans as bp')
            ->join('membership_plans as mp', 'bp.membership_plan_id', '=', 'mp.id')
            ->where('bp.business_id', '=', $business_id)
            ->select('mp.name')
            ->first();

        if($membership_plan) {
            return $membership_plan->name;
        }
        else {
            return null;
        }
    }
}