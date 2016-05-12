<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AdminRepository {

    /**
     * Get all super admins and system admins
     *
     * @return mixed
     */
    public  function  getAdmins()
    {
        $admins = DB::table('users as u')
            ->join('admins as a', 'u.id', '=', 'a.user_id')
            ->join('roles as r', 'a.role_id', '=', 'r.id')
            ->where(function($query) {
                $query->where('r.name', '=', 'Super Admin')
                    ->orWhere('r.name', '=', 'System Admin');
            })
            ->orderBy('u.created_at', 'desc')
            ->select('u.id', 'u.name', 'u.email', 'u.mobile_number', 'u.active', 'u.profile_picture', 'u.created_at', 'u.deleted_at', 'r.name as role', 'a.active as portal_active')
            ->paginate(10);

        return $admins;
    }

    /**
     * Get admin
     *
     * @param $id
     * @return mixed
     */
    public  function  getAdmin($id)
    {
        $admin = DB::table('users as u')
            ->join('admins as a', 'u.id', '=', 'a.user_id')
            ->join('roles as r', 'a.role_id', '=', 'r.id')
            ->where(function($query) {
                $query->where('r.name', '=', 'Super Admin')
                    ->orWhere('r.name', '=', 'System Admin');
            })
            ->where('u.id', '=', $id)
            ->select('u.id', 'u.name', 'u.email', 'u.mobile_number', 'u.active', 'u.profile_picture', 'u.created_at', 'u.deleted_at', 'r.name as role', 'a.active as portal_active')
            ->first();

        return $admin;
    }
}

