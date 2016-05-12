<?php

namespace App\Http\Controllers\Location;

use App\City;
use App\Http\Requests\CityRequest;
use App\Http\Requests\StateRequest;
use App\State;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

class LocationController extends Controller
{
    /**
     * Get all states
     *
     * @return mixed
     */
    public function states()
    {
        $states = State::withTrashed()->paginate(10);

        return view('locations.all-states', ['states' => $states]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showState($id)
    {
        $state = State::withTrashed()->findOrFail($id);

        return view('locations.show-state', ['state' => $state]);
    }

    /**
     * @return mixed
     */
    public function createState()
    {
        return view('locations.create-state');
    }

    /**
     * @param StateRequest $request
     * @return mixed
     */
    public function storeState(StateRequest $request)
    {
        $state = State::create(['name' => $request->get('name')]);

        Flash::success($state->name . ' has been successfully created.');

        return redirect(route('locations.states.all'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editState($id)
    {
        $state = State::withTrashed()->findOrFail($id);

        return view('locations.edit-state', ['state' => $state]);
    }

    /**
     * @param $id
     * @param StateRequest $request
     * @return mixed
     */
    public function updateState($id, StateRequest $request)
    {
        $state = State::withTrashed()->findOrFail($id);

        $state->update(['name' => $request->get('name')]);

        Flash::success($state->name . ' has been successfully updated.');

        return redirect(route('locations.states.all'));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroyState($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $state = State::withTrashed()->findOrFail($id);

                $state->delete();

                Flash::success('State has been successfully deleted.');

                return redirect(route('locations.states.all'));
            } else {
                return Response::view('errors.403');
            }
        }
    }

    /**
     * Get all cities
     *
     * @return mixed
     */
    public function cities()
    {
        $cities = City::withTrashed()->paginate(10);

        return view('locations.all-cities', ['cities' => $cities]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showCity($id)
    {
        $city = City::withTrashed()->findOrFail($id);

        return view('locations.show-city', ['city' => $city]);
    }

    /**
     * @return mixed
     */
    public function createCity()
    {
        $states = State::lists('name', 'name');

        return view('locations.create-city', ['states' => $states]);
    }

    /**
     * @param CityRequest $request
     * @return mixed
     */
    public function storeCity(CityRequest $request)
    {
        $state = State::where('name', '=', $request->get('state'))->firstOrFail();

        $city = City::create(['name' => $request->get('name'), 'state_id' => $state->id]);

        Flash::success($city->name . ' has been successfully created.');

        return redirect(route('locations.cities.all'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editCity($id)
    {
        $states = State::lists('name', 'name');

        $city = City::withTrashed()->findOrFail($id);

        $city->state = $city->state ? $city->state->name : null;

        return view('locations.edit-city', ['city' => $city, 'states' => $states]);
    }

    /**
     * @param $id
     * @param CityRequest $request
     * @return mixed
     */
    public function updateCity($id, CityRequest $request)
    {
        $state = State::where('name', '=', $request->get('state'))->firstOrFail();

        $city = City::withTrashed()->findOrFail($id);

        $city->update(['name' => $request->get('name'), 'state_id' => $state->id]);

        Flash::success($city->name . ' has been successfully updated.');

        return redirect(route('locations.cities.all'));
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function destroyCity($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $city = City::withTrashed()->findOrFail($id);

                $city->delete();

                Flash::success('City has been successfully deleted.');

                return redirect(route('locations.cities.all'));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
