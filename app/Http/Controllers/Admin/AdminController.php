<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Role;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    /**
     * Create a new controller instance.
     *
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->middleware('auth');

        $this->adminRepository = $adminRepository;
    }

    /**
     * Get all super admins and system admins
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $admins = $this->adminRepository->getAdmins();

        return view('admins.all', ['admins' => $admins]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $admin = $this->adminRepository->getAdmin($id);

        if ($admin) {
            return view('admins.show', ['admin' => $admin]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdminRequest $request)
    {
        $role = Role::where('name', '=', $request->get('role'))->firstOrFail();

        $admin = User::create(['name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'password' => $request->get('password'),
            'active' => 1
        ]);

        $admin->admins()->attach($role->id, ['active' => 1]);

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $filename = $admin->id . '_' . time() . '.' . $profile_picture->getClientOriginalExtension();
            Image::make($profile_picture)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $profile_picture_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $admin->update(['profile_picture' => $profile_picture_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($admin->name . ' has been successfully created.');

        return redirect(route('admins.all'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = $this->adminRepository->getAdmin($id);

        if ($admin) {
            return view('admins.edit', ['admin' => $admin]);
        } else {
            return Response::view('errors.404');
        }
    }

    /**
     * @param $id
     * @param AdminRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, AdminRequest $request)
    {
        $admin = User::withTrashed()->findOrFail($id);

        $role = Role::where('name', '=', $request->get('role'))->firstOrFail();

        if (empty($request->get('password'))) {
            $admin->update(['name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile_number' => $request->get('mobile_number')
            ]);
        } else {
            $admin->update(['name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile_number' => $request->get('mobile_number'),
                'password' => $request->get('password')
            ]);
        }

        if ($admin->admins->first()->name != $role->name) {
            $admin->admins()->detach();

            $admin->admins()->attach($role->id, ['active' => 1]);
        } else {
            $portal_active = $request->get('portal_active') == "on" ? 1 : 0;

            if ($admin->admins->first()->pivot->active != $portal_active) {
                $admin->admins()->updateExistingPivot($role->id, ['active' => $portal_active]);
            }
        }

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $filename = $admin->id . '_' . time() . '.' . $profile_picture->getClientOriginalExtension();
            Image::make($profile_picture)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));
            $s3 = App::make('aws')->createClient('s3');
            $profile_picture_url = $s3->putObject(array(
                'Bucket' => env('AWS_BUCKET', ''),
                'Key' => $filename,
                'SourceFile' => 'images/uploads/' . $filename,
            ));
            $admin->update(['profile_picture' => $profile_picture_url['ObjectURL']]);
            if (File::exists(public_path('/images/uploads/' . $filename))) {
                File::delete(public_path('/images/uploads/' . $filename));
            }
        }

        Flash::success($admin->name . ' has been successfully updated.');

        return redirect(route('admins.all'));
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
                $admin = User::withTrashed()->findOrFail($id);

                $admin->delete();

                Flash::success('Admin has been successfully deleted.');

                return redirect(route('admins.show', $admin->id));
            } else {
                return Response::view('errors.403');
            }
        }
    }
}
