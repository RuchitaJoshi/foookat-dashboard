<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\Category;
use App\DealDays;
use App\DealImages;
use App\League;
use App\Role;
use App\State;
use App\StoreHours;
use App\StoreImages;
use App\User;
use App\Store;
use App\Deal;
use App\MembershipPlan;
use File;
use App\Http\Requests\BusinessRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\DealRequest;
use App\Repositories\BusinessRepository;
use App\Repositories\DealRepository;
use App\Repositories\StoreRepository;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
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
     * @var DealRepository
     */
    private $dealRepository;

    /**
     * Create a new controller instance.
     *
     * @param BusinessRepository $businessRepository
     * @param StoreRepository $storeRepository
     * @param DealRepository $dealRepository
     */
    public function __construct(BusinessRepository $businessRepository, StoreRepository $storeRepository, DealRepository $dealRepository)
    {
        $this->middleware('auth');

        $this->businessRepository = $businessRepository;

        $this->storeRepository = $storeRepository;

        $this->dealRepository = $dealRepository;
    }

    /**
     * Get all businesses
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $businesses = $this->businessRepository->getBusinesses();

        return view('businesses.all', ['businesses' => $businesses]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BusinessRequest $request)
    {
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
            'approved' => 'Approved',
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $business->users()->attach($user->id, ['role_id' => $role->id, 'active' => 1]);

        $business->membershipPlan()->attach($membershipPlan->id);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = $business->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $logo_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $business->update(['logo' => $logo_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($business->name . ' has been successfully created.');

        return redirect(route('businesses.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, BusinessRequest $request)
    {
        $business = Business::withTrashed()->findOrFail($id);

        $membershipPlan = MembershipPlan::where('name', '=', $request->get('membership_plan'))->firstOrFail();

        $business->update(['name' => $request->get('name'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'type' => $request->get('type'),
            'active' => $request->get('active') == "on" ? 1 : 0,
            'approved' => $request->get('approved'),
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $business->membershipPlan()->detach();

        $business->membershipPlan()->attach($membershipPlan->id);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = $business->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $logo_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $business->update(['logo' => $logo_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($business->name . ' has been successfully updated.');

        return redirect(route('businesses.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $business = Business::withTrashed()->findOrFail($id);

                $business->delete();

                Flash::success('Business has been successfully deleted.');

                return redirect(route('businesses.show', $business->id));
            } else {
                return Response::view('errors.403');
            }
        }
    }

    /**
     * Get all stores
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stores($id)
    {
        $business = Business::withTrashed()->findOrFail($id);

        $stores = $this->storeRepository->getStores($id);

        return view('businesses.stores', ['business' => $business, 'stores' => $stores]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createStore($id)
    {
        $business = Business::withTrashed()->findOrFail($id);

        $states = State::lists('name', 'name');

        $leagues = League::lists('name', 'name');

        return view('businesses.create-store', ['business' => $business, 'states' => $states, 'leagues' => $leagues, 'cities' => []]);
    }

    /**
     * @param $id
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeStore($id, StoreRequest $request)
    {
        $league = League::where('name', '=', $request->get('league'))->firstOrFail();

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
            'mobile_number' => '+91' . $request->get('mobile_number'),
            'phone_number' => $request->get('phone_number'),
            'business_id' => $id,
            'active' => 1,
            'approved' => 'Approved',
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $store->league()->attach($league->id);

        $storeHours = new StoreHours;

        $storeHours->mon_open = $request->get('mon_open');
        $storeHours->mon_close = $request->get('mon_close');
        $storeHours->tue_open = $request->get('tue_open');
        $storeHours->tue_close = $request->get('tue_close');
        $storeHours->wed_open = $request->get('wed_open');
        $storeHours->wed_close = $request->get('wed_close');
        $storeHours->thu_open = $request->get('thu_open');
        $storeHours->thu_close = $request->get('thu_close');
        $storeHours->fri_open = $request->get('fri_open');
        $storeHours->fri_close = $request->get('fri_close');
        $storeHours->sat_open = $request->get('sat_open');
        $storeHours->sat_close = $request->get('sat_close');
        $storeHours->sun_open = $request->get('sun_open');
        $storeHours->sun_close = $request->get('sun_close');

        $store->hours()->save($storeHours);

        $storeImages = new StoreImages;

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $filename = $store->id . '_' . time() . '.' . $image1->getClientOriginalExtension();
            Image::make($image1)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image1_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image1 = $image1_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $filename = $store->id . '_' . time() . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image2_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image2 = $image2_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $filename = $store->id . '_' . time() . '.' . $image3->getClientOriginalExtension();
            Image::make($image3)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image3_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image3 = $image3_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if (!empty($storeImages->image1) || !empty($storeImages->image2) || !empty($storeImages->image3)) {
            if($request->get('cover') ==  'image1') {
                $storeImages->cover_image1 = true;
            }
            if($request->get('cover') ==  'image2') {
                $storeImages->cover_image2 = true;
            }
            if($request->get('cover') ==  'image3') {
                $storeImages->cover_image3 = true;
            }
            $store->images()->save($storeImages);
        }

        Flash::success($store->name . ' has been successfully created.');

        return redirect(route('businesses.stores', $id));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param $business_id
     * @param $store_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editStore($business_id, $store_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = $this->storeRepository->getStore($store_id);

        $states = State::lists('name', 'name');

        $leagues = League::lists('name', 'name');

        if ($store) {
            $cities = Helper::getCities($store->state);

            return view('businesses.edit-store', ['states' => $states, 'cities' => $cities, 'leagues' => $leagues, 'business' => $business, 'store' => $store]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateStore($business_id, $store_id, StoreRequest $request)
    {
        $store = Store::withTrashed()->findOrFail($store_id);

        $league = League::where('name', '=', $request->get('league'))->firstOrFail();

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
            'mobile_number' => '+91' . $request->get('mobile_number'),
            'phone_number' => $request->get('phone_number'),
            'active' => $request->get('active') == "on" ? 1 : 0,
            'approved' => $request->get('approved'),
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $store->league()->detach();

        $store->league()->attach($league->id);

        $storeHours = $store->hours;

        $storeHours->mon_open = $request->get('mon_open');
        $storeHours->mon_close = $request->get('mon_close');
        $storeHours->tue_open = $request->get('tue_open');
        $storeHours->tue_close = $request->get('tue_close');
        $storeHours->wed_open = $request->get('wed_open');
        $storeHours->wed_close = $request->get('wed_close');
        $storeHours->thu_open = $request->get('thu_open');
        $storeHours->thu_close = $request->get('thu_close');
        $storeHours->fri_open = $request->get('fri_open');
        $storeHours->fri_close = $request->get('fri_close');
        $storeHours->sat_open = $request->get('sat_open');
        $storeHours->sat_close = $request->get('sat_close');
        $storeHours->sun_open = $request->get('sun_open');
        $storeHours->sun_close = $request->get('sun_close');

        $store->hours()->save($storeHours);

        $storeImages = $store->images;

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $filename = $store->id . '_' . time() . '.' . $image1->getClientOriginalExtension();
            Image::make($image1)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image1_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image1 = $image1_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $filename = $store->id . '_' . time() . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image2_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image2 = $image2_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $filename = $store->id . '_' . time() . '.' . $image3->getClientOriginalExtension();
            Image::make($image3)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image3_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $storeImages->image3 = $image3_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if (!empty($storeImages->image1) || !empty($storeImages->image2) || !empty($storeImages->image3)) {
            if($request->get('cover') ==  'image1') {
                $storeImages->cover_image1 = true;
            }
            if($request->get('cover') ==  'image2') {
                $storeImages->cover_image2 = true;
            }
            if($request->get('cover') ==  'image3') {
                $storeImages->cover_image3 = true;
            }
            $store->images()->save($storeImages);
        }

        Flash::success($store->name . ' has been successfully updated.');

        return redirect(route('businesses.stores', $business_id));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyStore($business_id, $store_id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $store = Store::withTrashed()->findOrFail($store_id);

                $store->delete();

                Flash::success('Store has been successfully deleted.');

                return redirect(route('businesses.stores.show', [$business_id, $store->id]));
            } else {
                return Response::view('errors.403');
            }
        }
    }

    /**
     * Get all deals
     *
     * @param $business_id
     * @param $store_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deals($business_id, $store_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = Store::withTrashed()->findOrFail($store_id);

        $deals = $this->dealRepository->getDeals($store_id);

        return view('businesses.deals', ['business' => $business, 'store' => $store, 'deals' => $deals]);
    }

    /**
     * @param $business_id
     * @param $store_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createDeal($business_id, $store_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = Store::withTrashed()->findOrFail($store_id);

        $categories = Category::lists('name', 'name');

        return view('businesses.create-deal', ['business' => $business, 'store' => $store, 'categories' => $categories]);
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param DealRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeDeal($business_id, $store_id, DealRequest $request)
    {
        $category = Category::where('name', '=', $request->get('category'))->firstOrFail();

        $deal = Deal::create(['name' => $request->get('name'),
            'details' => $request->get('details'),
            'overview' => $request->get('overview'),
            'original_price' => $request->get('original_price'),
            'percentage_off' => $request->get('percentage_off') ? $request->get('percentage_off') : null,
            'amount_off' => $request->get('amount_off') ? $request->get('amount_off') : null,
            'new_price' => $request->get('new_price'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'redeem_code' => $request->get('redeem_code'),
            'store_id' => $store_id,
            'active' => 1,
            'approved' => 'Approved',
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $deal->category()->attach($category->id);

        $dealDays = new DealDays;

        foreach ($request->get('deal_days') as $day) {
            if ($day == 'mon') {
                $dealDays->mon = 1;
            }
            if ($day == 'tue') {
                $dealDays->tue = 1;
            }
            if ($day == 'wed') {
                $dealDays->wed = 1;
            }
            if ($day == 'thu') {
                $dealDays->thu = 1;
            }
            if ($day == 'fri') {
                $dealDays->fri = 1;
            }
            if ($day == 'sat') {
                $dealDays->sat = 1;
            }
            if ($day == 'sun') {
                $dealDays->sun = 1;
            }
        }

        $deal->days()->save($dealDays);

        $dealImages = new DealImages;

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $filename = $deal->id . '_' . time() . '.' . $image1->getClientOriginalExtension();
            Image::make($image1)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image1_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image1 = $image1_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $filename = $deal->id . '_' . time() . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image2_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image2 = $image2_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $filename = $deal->id . '_' . time() . '.' . $image3->getClientOriginalExtension();
            Image::make($image3)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image3_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image3 = $image3_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if (!empty($dealImages->image1) || !empty($dealImages->image2) || !empty($dealImages->image3)) {
            if($request->get('cover') ==  'image1') {
                $dealImages->cover_image1 = true;
            }
            if($request->get('cover') ==  'image2') {
                $dealImages->cover_image2 = true;
            }
            if($request->get('cover') ==  'image3') {
                $dealImages->cover_image3 = true;
            }
            $deal->images()->save($dealImages);
        }

        Flash::success($deal->name . ' has been successfully created.');

        return redirect(route('businesses.stores.deals', [$business_id, $store_id]));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param $deal_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDeal($business_id, $store_id, $deal_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = Store::withTrashed()->findOrFail($store_id);

        $deal = $this->dealRepository->getDeal($deal_id);

        if ($deal) {
            return view('businesses.show-deal', ['business' => $business, 'store' => $store, 'deal' => $deal]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param $deal_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editDeal($business_id, $store_id, $deal_id)
    {
        $business = Business::withTrashed()->findOrFail($business_id);

        $store = $this->storeRepository->getStore($store_id);

        $deal = $this->dealRepository->getDeal($deal_id);

        $categories = Category::lists('name', 'name');

        if ($deal) {
            return view('businesses.edit-deal', ['business' => $business, 'store' => $store, 'deal' => $deal, 'categories' => $categories]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param $deal_id
     * @param DealRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateDeal($business_id, $store_id, $deal_id, DealRequest $request)
    {
        $deal = Deal::withTrashed()->findOrFail($deal_id);

        $category = Category::where('name', '=', $request->get('category'))->firstOrFail();

        $deal->update(['name' => $request->get('name'),
            'details' => $request->get('details'),
            'overview' => $request->get('overview'),
            'original_price' => $request->get('original_price'),
            'percentage_off' => $request->get('percentage_off') ? $request->get('percentage_off') : null,
            'amount_off' => $request->get('amount_off') ? $request->get('amount_off') : null,
            'new_price' => $request->get('new_price'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time'),
            'redeem_code' => $request->get('redeem_code'),
            'active' => $request->get('active') == "on" ? 1 : 0,
            'approved' => $request->get('approved'),
            'note' => $request->get('note') ? $request->get('note') : null
        ]);

        $deal->category()->detach();

        $deal->category()->attach($category->id);

        $dealDays = $deal->days;

        foreach ($request->get('deal_days') as $day) {
            if ($day == 'mon') {
                $dealDays->mon = 1;
            }
            if ($day == 'tue') {
                $dealDays->tue = 1;
            }
            if ($day == 'wed') {
                $dealDays->wed = 1;
            }
            if ($day == 'thu') {
                $dealDays->thu = 1;
            }
            if ($day == 'fri') {
                $dealDays->fri = 1;
            }
            if ($day == 'sat') {
                $dealDays->sat = 1;
            }
            if ($day == 'sun') {
                $dealDays->sun = 1;
            }
        }

        $deal->days()->save($dealDays);

        $dealImages = $deal->images;

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $filename = $deal->id . '_' . time() . '.' . $image1->getClientOriginalExtension();
            Image::make($image1)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image1_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image1 = $image1_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $filename = $deal->id . '_' . time() . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image2_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image2 = $image2_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $filename = $deal->id . '_' . time() . '.' . $image3->getClientOriginalExtension();
            Image::make($image3)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $image3_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $dealImages->image3 = $image3_url['ObjectURL'];
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        if (!empty($dealImages->image1) || !empty($dealImages->image2) || !empty($dealImages->image3)) {
            if($request->get('cover') ==  'image1') {
                $dealImages->cover_image1 = true;
            }
            if($request->get('cover') ==  'image2') {
                $dealImages->cover_image2 = true;
            }
            if($request->get('cover') ==  'image3') {
                $dealImages->cover_image3 = true;
            }
            $deal->images()->save($dealImages);
        }

        Flash::success($deal->name . ' has been successfully updated.');

        return redirect(route('businesses.stores.deals', [$business_id, $store_id]));
    }

    /**
     * @param $business_id
     * @param $store_id
     * @param $deal_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyDeal($business_id, $store_id, $deal_id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $deal = Deal::withTrashed()->findOrFail($deal_id);

                $deal->delete();

                Flash::success('Deal has been successfully deleted.');

                return redirect(route('businesses.stores.deals.show', [$business_id, $store_id, $deal_id]));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
