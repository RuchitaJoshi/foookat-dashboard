<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use File;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $users = User::withTrashed()->latest()->paginate(10);

        return view('users.all', ['users' => $users]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('users.show', ['user' => $user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserRequest $request)
    {
        $user = User::create(['name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'password' => $request->get('password'),
            'active' => 1
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $filename = $user->id . '_' . time() . '.' . $profile_picture->getClientOriginalExtension();
            Image::make($profile_picture)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $profile_picture_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $user->update(['profile_picture' => $profile_picture_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($user->name. ' has been successfully created.');

        return redirect(route('users.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * @param $id
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $filename = $user->id . '_' . time() . '.' . $profile_picture->getClientOriginalExtension();
            Image::make($profile_picture)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $profile_picture_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $user->update(['profile_picture' => $profile_picture_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($user->name. ' has been successfully updated.');

        return redirect(route('users.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
            if (Auth::user()->is('System Admin') || Auth::user()->is('Super Admin')) {
                $user = User::withTrashed()->findOrFail($id);

                $user->delete();

                Flash::success('User has been successfully deleted.');

                return redirect(route('users.show', $user->id));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
