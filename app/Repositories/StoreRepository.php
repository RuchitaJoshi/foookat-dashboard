<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StoreRepository
{
    /**
     * Get store
     *
     * @param $id
     * @return mixed
     */
    public function getStore($id)
    {
        $store = DB::table('stores as s')
            ->leftjoin('stores_hours as sh', 's.id', '=', 'sh.store_id')
            ->leftjoin('stores_leagues as sl', 's.id', '=', 'sl.store_id')
            ->leftjoin('leagues as l', function ($query) {
                $query->on('sl.league_id', '=', 'l.id');
            })
            ->where('s.id', '=', $id)
            ->select('s.id', 's.name', 's.overview', 's.address', 's.city', 's.state', 's.zip_code', 's.latitude', 's.longitude', 's.email', 's.mobile_number', 's.phone_number', 's.active', 's.created_at', 's.deleted_at', 'sh.mon_open', 'sh.mon_close', 'sh.tue_open', 'sh.tue_close', 'sh.wed_open', 'sh.wed_close', 'sh.thu_open', 'sh.thu_close', 'sh.fri_open', 'sh.fri_close', 'sh.sat_open', 'sh.sat_close', 'sh.sun_open', 'sh.sun_close', 'l.name as league')
            ->first();

        return $store;
    }
}