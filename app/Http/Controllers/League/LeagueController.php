<?php

namespace App\Http\Controllers\League;

use App\League;
use App\Http\Requests\LeagueRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

class LeagueController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all leagues
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $leagues = League::withTrashed()->latest()->paginate(10);

        return view('leagues.all', ['leagues' => $leagues]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('leagues.create');
    }

    /**
     *
     * @param LeagueRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(LeagueRequest $request)
    {
        $league = League::create(['name' => $request->get('name')]);

        Flash::success($league->name . ' has been successfully created.');

        return redirect(route('leagues.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $league = League::withTrashed()->findOrFail($id);

        return view('leagues.show', ['league' => $league]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $league = League::withTrashed()->findOrFail($id);

        return view('leagues.edit', ['league' => $league]);
    }

    /**
     * @param $id
     * @param LeagueRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, LeagueRequest $request)
    {
        $league = League::withTrashed()->findOrFail($id);

        $league->update(['name' => $request->get('name')]);

        Flash::success($league->name . ' has been successfully updated.');

        return redirect(route('leagues.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $league = League::withTrashed()->findOrFail($id);

                $league->delete();

                Flash::success('League has been successfully deleted.');

                return redirect(route('leagues.all'));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
