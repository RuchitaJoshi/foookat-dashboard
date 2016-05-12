<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function all()
    {
        $users = User::withTrashed()->latest()->paginate(10);

        return view('users.all', ['users' => $users]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('users.show', ['user' => $user]);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request)
    {
        $user = User::create(['name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'password' => $request->get('password'),
            'active' => 1
        ]);

        Flash::success($user->name. ' has been successfully created.');

        return redirect('users/all');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * @param $id
     * @param UserRequest $request
     * @return mixed
     */
    public function update($id, UserRequest $request)
    {
        $user = User::withTrashed()->findOrFail($id);

        if(empty($request->get('password')))
        {
            $user->update(['name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile_number' => $request->get('mobile_number') ? $request->get('mobile_number') : null,
                'active' => $request->get('active') == "on" ? 1 : 0
            ]);
        }
        else
        {
            $user->update(['name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile_number' => $request->get('mobile_number') ? $request->get('mobile_number') : null,
                'active' => $request->get('active') == "on" ? 1 : 0,
                'password' => $request->get('password')
            ]);
        }

        Flash::success($user->name. ' has been successfully updated.');

        return redirect('users/all');
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
                $user = User::withTrashed()->findOrFail($id);

                $user->delete();

                Flash::success('User has been successfully deleted.');

                return redirect('users/all');
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
