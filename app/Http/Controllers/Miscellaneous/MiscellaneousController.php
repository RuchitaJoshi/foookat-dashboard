<?php

namespace App\Http\Controllers\Miscellaneous;

use App\Business;
use App\Deal;
use App\State;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get cities
     *
     * @param Request $request
     * @return Response
     */
    public function cities(Request $request)
    {
        $state = State::where('name', '=', $request->get('state'))->firstOrFail();

        $cities = $state->cities;

        return Response::json($cities);
    }

    /**
     * delete profile picture
     *
     * @param Request $request
     * @return Response
     */
    public function deleteProfilePicture(Request $request)
    {
        $admin = User::withTrashed()->findOrFail($request->get('id'));

        if($admin) {
            $admin->update(['profile_picture' => null]);
            return Response::json(true);
        }
        else {
            return Response::json(false);
        }
    }

    /**
     * delete business logo
     *
     * @param Request $request
     * @return Response
     */
    public function deleteBusinessLogo(Request $request)
    {
        $business = Business::withTrashed()->findOrFail($request->get('id'));

        if ($business) {
            $business->update(['logo' => null]);
            return Response::json(true);
        } else {
            return Response::json(false);
        }
    }

    /**
     * delete store image
     *
     * @param Request $request
     * @return Response
     */
    public function deleteStoreImage(Request $request)
    {
        $store = Store::withTrashed()->findOrFail($request->get('id'));

        if ($store) {
            $storeImages = $store->images;
            if($request->get('number') == 1) {
                $storeImages->image1 = null;
                $storeImages->cover_image1 = 0;
            }
            if ($request->get('number') == 2) {
                $storeImages->image2 = null;
                $storeImages->cover_image2 = 0;
            }
            if ($request->get('number') == 3) {
                $storeImages->image3 = null;
                $storeImages->cover_image3 = 0;
            }
            $store->images()->save($storeImages);
            return Response::json(true);
        } else {
            return Response::json(false);
        }
    }

    /**
     * delete deal image
     *
     * @param Request $request
     * @return Response
     */
    public function deleteDealImage(Request $request)
    {
        $deal = Deal::withTrashed()->findOrFail($request->get('id'));

        if ($deal) {
            $dealImages = $deal->images;
            if($request->get('number') == 1) {
                $dealImages->image1 = null;
                $dealImages->cover_image1 = 0;
            }
            if ($request->get('number') == 2) {
                $dealImages->image2 = null;
                $dealImages->cover_image2 = 0;
            }
            if ($request->get('number') == 3) {
                $dealImages->image3 = null;
                $dealImages->cover_image3 = 0;
            }
            $deal->images()->save($dealImages);
            return Response::json(true);
        } else {
            return Response::json(false);
        }
    }
}
