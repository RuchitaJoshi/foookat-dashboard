<?php

namespace App\Http\Controllers\MembershipPlan;

use App\Category;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $membershipPlans = MembershipPlan::withTrashed()->get();

        $categories = Category::all();

        return view('membershipPlans.all', ['membershipPlans' => $membershipPlans, 'categories' => $categories]);
    }
}
