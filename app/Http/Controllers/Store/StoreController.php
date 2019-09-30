<?php

namespace App\Http\Controllers\Store;

use App\Business;
use App\Repositories\BusinessRepository;
use App\Repositories\DealRepository;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class StoreController extends Controller
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
     * Get all stores
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $stores = $this->storeRepository->getStores();

        return view('stores.all', ['stores' => $stores]);
    }

    /**
     * @param $store_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($store_id)
    {
        $store = $this->storeRepository->getStore($store_id);

        if ($store) {
            $business = Business::withTrashed()->findOrFail($store->business_id);

            return view('stores.show', ['business' => $business, 'store' => $store]);
        } else {
            return Response::view('errors.404');
        }
    }
}
