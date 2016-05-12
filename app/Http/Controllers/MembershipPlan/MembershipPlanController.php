<?php

namespace App\Http\Controllers\MembershipPlan;

use App\MembershipPlan;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MembershipPlanController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all categories
     *
     * @return mixed
     */
    public function all()
    {
        $membershipPlans = MembershipPlan::withTrashed()->latest()->paginate(10);

        return view('membershipPlans.all', ['membershipPlans' => $membershipPlans]);
    }
}
