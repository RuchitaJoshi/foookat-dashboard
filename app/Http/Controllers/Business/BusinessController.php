<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Helpers\Helper;
use App\Http\Requests\BusinessRequest;
use App\Http\Requests\StoreRequest;
use App\League;
use App\MembershipPlan;
use App\Repositories\BusinessRepository;
use App\Repositories\StoreRepository;
use App\Role;
use App\State;
use App\StoreHours;
use App\User;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    /**
     * @var StoreRepository
     */
    private $storeRepository;

    /**
     * Create a new controller instance.
     * @param BusinessRepository $businessRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(BusinessRepository $businessRepository, StoreRepository $storeRepository)
    {
        $this->middleware('auth');

        $this->businessRepository = $businessRepository;

        $this->storeRepository = $storeRepository;
    }

    /**
     * Get all businesses
     *
     * @return mixed
     */
    public function all()
    {
        $businesses = $this->businessRepository->getBusinesses();

        return view('businesses.all', ['businesses' => $businesses]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $business = $this->businessRepository->getBusiness($id);

        if ($business) {
            return view('businesses.show', ['business' => $business]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $states = State::lists('name', 'name');

        $membership_plans = MembershipPlan::lists('name', 'name');

        $plan = null;

        if ($request->has('plan')) {
            $plan = $request->input('plan');
        }

        return view('businesses.create', ['states' => $states, 'cities' => [], 'membership_plans' => $membership_plans, 'plan' => $plan]);
    }

    /**
     * @param BusinessRequest $request
     * @return mixed
     */
    public function store(BusinessRequest $request)
    {
        dd($request->get('note'));

        $role = Role::where('name', '=', 'Business Owner')->firstOrFail();

        $membershipPlan = MembershipPlan::where('name', '=', $request->get('membership_plan'))->firstOrFail();

        $user = User::create(['name' => $request->get('owner_name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'password' => $request->get('password'),
            'active' => 1
        ]);

        $business = Business::create(['name' => $request->get('name'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'type' => $request->get('type'),
            'active' => 1,
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $business->users()->attach($user->id, ['role_id' => $role->id, 'active' => 1]);

        $business->membershipPlan()->attach($membershipPlan->id);

        Flash::success($business->name . ' has been successfully created.');

        return redirect('businesses/all');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $business = $this->businessRepository->getBusiness($id);

        $states = State::lists('name', 'name');

        $membership_plans = MembershipPlan::lists('name', 'name');

        if ($business) {
            $cities = Helper::getCities($business->state);

            $plan = $this->businessRepository->getMembershipPlan($business->id);

            return view('businesses.edit', ['states' => $states, 'cities' => $cities, 'membership_plans' => $membership_plans, 'plan' => $plan, 'business' => $business]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $id
     * @param BusinessRequest $request
     * @return mixed
     */
    public function update($id, BusinessRequest $request)
    {
        $membershipPlan = MembershipPlan::where('name', '=', $request->get('membership_plan'))->firstOrFail();

        $business = Business::withTrashed()->findOrFail($id);

        $business->update(['name' => $request->get('name'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'type' => $request->get('type'),
            'active' => $request->get('active') == "on" ? 1 : 0,
            'status' => $request->get('status'),
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $business->membershipPlan()->detach();

        $business->membershipPlan()->attach($membershipPlan->id);

        Flash::success($business->name . ' has been successfully updated.');

        return redirect('businesses/all');
    }

    /**
     * Get cities
     *
     * @param Request $request
     * @return mixed
     */
    public function cities(Request $request)
    {
        $state = State::where('name', '=', $request->get('state'))->firstOrFail();

        $cities = $state->cities;

        return Response::json($cities);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $business = Business::withTrashed()->findOrFail($id);

                $business->delete();

                Flash::success('Business has been successfully deleted.');

                return redirect('businesses/all');
            } else {
                return Response::view('errors.403');
            }
        }
    }

    /**
     * Get all stores
     *
     * @param $id
     * @return mixed
     */
    public function stores($id)
    {
        $business = Business::withTrashed()->findOrFail($id);

        $stores = $business->stores()->withTrashed()->latest()->paginate(10);

        return view('businesses.stores', ['business' => $business, 'stores' => $stores]);
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return mixed
     * @internal param $id
     */
    public function showStore($business_id, $store_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = $this->storeRepository->getStore($store_id);

        if ($store) {
            return view('businesses.show-store', ['business' => $business, 'store' => $store]);
        } else {
            return Response::view('errors.404');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function createStore($id)
    {
        $business = Business::withTrashed()->findOrFail($id);

        $states = State::lists('name', 'name');

        $leagues = League::lists('name', 'name');

        return view('businesses.create-store', ['business' => $business, 'states' => $states, 'leagues' => $leagues, 'cities' => []]);
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return mixed
     */
    public function storeStore($id, StoreRequest $request)
    {
        $geocode = Helper::getGeocode($request->get('address'), $request->get('zip_code'));

        $store = Store::create(['name' => $request->get('name'),
            'overview' => $request->get('overview'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'latitude' => $geocode['latitude'],
            'longitude' => $geocode['longitude'],
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'phone_number' => $request->get('phone_number'),
            'business_id' => $id,
            'active' => 1,
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $storeHours = new StoreHours;

        $storeHours->mon_open  = $request->get('mon_open');
        $storeHours->mon_close = $request->get('mon_close');
        $storeHours->tue_open  = $request->get('tue_open');
        $storeHours->tue_close = $request->get('tue_close');
        $storeHours->wed_open  = $request->get('wed_open');
        $storeHours->wed_close = $request->get('wed_close');
        $storeHours->thu_open  = $request->get('thu_open');
        $storeHours->thu_close = $request->get('thu_close');
        $storeHours->fri_open  = $request->get('fri_open');
        $storeHours->fri_close = $request->get('fri_close');
        $storeHours->sat_open  = $request->get('sat_open');
        $storeHours->sat_close = $request->get('sat_close');
        $storeHours->sun_open  = $request->get('sun_open');
        $storeHours->sun_close = $request->get('sun_close');

        $store->hours()->save($storeHours);

        Flash::success($store->name . ' has been successfully created.');

        return redirect(route('businesses.stores', $id));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return mixed
     * @internal param $id
     */
    public function editStore($business_id, $store_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = $this->storeRepository->getStore($store_id);

        $states = State::lists('name', 'name');

        $leagues = League::lists('name', 'name');

        if ($store) {
            $cities = Helper::getCities($store->state);
            
            return view('businesses.edit-store', ['states' => $states, 'cities' => $cities, 'leagues' => $leagues,'business' => $business, 'store' => $store]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param StoreRequest $request
     * @return mixed
     */
    public function updateStore($business_id, $store_id, StoreRequest $request)
    {
        $store = Store::withTrashed()->findOrFail($store_id);

        $geocode = Helper::getGeocode($request->get('address'), $request->get('zip_code'));

        $store->update(['name' => $request->get('name'),
            'overview' => $request->get('overview'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'latitude' => $geocode['latitude'],
            'longitude' => $geocode['longitude'],
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'phone_number' => $request->get('phone_number'),
            'active' => $request->get('active') == "on" ? 1 : 0,
            'status' => $request->get('status'),
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $storeHours = $store->hours;

        $storeHours->mon_open  = $request->get('mon_open');
        $storeHours->mon_close = $request->get('mon_close');
        $storeHours->tue_open  = $request->get('tue_open');
        $storeHours->tue_close = $request->get('tue_close');
        $storeHours->wed_open  = $request->get('wed_open');
        $storeHours->wed_close = $request->get('wed_close');
        $storeHours->thu_open  = $request->get('thu_open');
        $storeHours->thu_close = $request->get('thu_close');
        $storeHours->fri_open  = $request->get('fri_open');
        $storeHours->fri_close = $request->get('fri_close');
        $storeHours->sat_open  = $request->get('sat_open');
        $storeHours->sat_close = $request->get('sat_close');
        $storeHours->sun_open  = $request->get('sun_open');
        $storeHours->sun_close = $request->get('sun_close');

        $store->hours()->save($storeHours);

        Flash::success($store->name . ' has been successfully created.');

        return redirect(route('businesses.stores', $business_id));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return mixed
     * @throws \Exception
     * @internal param $id
     */
    public function destroyStore($business_id, $store_id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $store = Store::withTrashed()->findOrFail($store_id);

                $store->delete();

                Flash::success('Store has been successfully deleted.');

                return redirect(route('businesses.stores', $business_id));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
