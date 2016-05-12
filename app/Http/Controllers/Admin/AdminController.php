<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Role;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    /**
     * Create a new controller instance.
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
     * @return mixed
     */
    public function all()
    {
        $admins = $this->adminRepository->getAdmins();

        return view('admins.all', ['admins' => $admins]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $admin = $this->adminRepository->getAdmin($id);

        if($admin) {
            return view('admins.show', ['admin' => $admin]);
        }
        else {
            return Response::view('errors.404');
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * @param AdminRequest $request
     * @return mixed
     */
    public function store(AdminRequest $request)
    {
        $s3 = App::make('aws')->createClient('s3');

        dd($s3->putObject(array(
            'Bucket'     => 'foookat',
            'Key'        => 'cafe',
            'SourceFile' => 'images/logo/foookat_logo_alpha.png',
        )));
        
        $role = Role::where('name', '=', $request->get('role'))->firstOrFail();

        $admin = User::create(['name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'password' => $request->get('password'),
            'active' => 1
        ]);

        $admin->admins()->attach($role->id, ['active' => 1]);

        Flash::success($admin->name . ' has been successfully created.');

        return redirect('admins/all');
    }

    /**
     * @param $id
     * @return mixed
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
     * @return mixed
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
        }
        else {
            $portal_active = $request->get('portal_active') == "on" ? 1 : 0;

            if($admin->admins->first()->pivot->active != $portal_active) {
                $admin->admins()->updateExistingPivot($role->id,['active' => $portal_active]);
            }
        }

        Flash::success($admin->name . ' has been successfully updated.');

        return redirect('admins/all');
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
                $admin = User::withTrashed()->findOrFail($id);

                $admin->delete();

                Flash::success('Admin has been successfully deleted.');

                return redirect('admins/all');
            } else {
                return Response::view('errors.403');
            }
        }
    }

}
