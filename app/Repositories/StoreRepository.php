<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StoreRepository
{
    /**
     * Get stores
     *
     * @param $id
     * @return mixed
     */
    public function getStores($id = null)
    {
        if(!empty($id)) {
            $stores = DB::table('stores as s')
                ->join('businesses as b', 's.business_id', '=', 'b.id')
                ->leftjoin('stores_hours as sh', 's.id', '=', 'sh.store_id')
                ->leftjoin('stores_images as si', 's.id', '=', 'si.store_id')
                ->leftjoin('stores_leagues as sl', 's.id', '=', 'sl.store_id')
                ->leftjoin('leagues as l', function ($query) {
                    $query->on('sl.league_id', '=', 'l.id');
                })
                ->where('s.business_id', '=', $id)
                ->orderBy('s.created_at', 'desc')
                ->select('s.*', 'b.name as business_name', 'si.image1', 'si.cover_image1', 'si.image2', 'si.cover_image2', 'si.image3', 'si.cover_image3', 'sh.mon_open', 'sh.mon_close', 'sh.tue_open', 'sh.tue_close', 'sh.wed_open', 'sh.wed_close', 'sh.thu_open', 'sh.thu_close', 'sh.fri_open', 'sh.fri_close', 'sh.sat_open', 'sh.sat_close', 'sh.sun_open', 'sh.sun_close', 'l.name as league')
                ->paginate(10);
        }
        else {
            $stores = DB::table('stores as s')
                ->join('businesses as b', 's.business_id', '=', 'b.id')
                ->leftjoin('stores_hours as sh', 's.id', '=', 'sh.store_id')
                ->leftjoin('stores_images as si', 's.id', '=', 'si.store_id')
                ->leftjoin('stores_leagues as sl', 's.id', '=', 'sl.store_id')
                ->leftjoin('leagues as l', function ($query) {
                    $query->on('sl.league_id', '=', 'l.id');
                })
                ->orderBy('s.created_at', 'desc')
                ->select('s.*', 'b.name as business_name', 'si.image1', 'si.cover_image1', 'si.image2', 'si.cover_image2', 'si.image3', 'si.cover_image3', 'sh.mon_open', 'sh.mon_close', 'sh.tue_open', 'sh.tue_close', 'sh.wed_open', 'sh.wed_close', 'sh.thu_open', 'sh.thu_close', 'sh.fri_open', 'sh.fri_close', 'sh.sat_open', 'sh.sat_close', 'sh.sun_open', 'sh.sun_close', 'l.name as league')
                ->paginate(10);
        }

        return $stores;
    }

    /**
     * Get a store
     *
     * @param $id
     * @return mixed
     */
    public function getStore($id)
    {
        $store = DB::table('stores_reviews as sr')
            ->leftjoin('stores_hours as sh', 's.id', '=', 'sh.store_id')
            ->leftjoin('stores_images as si', 's.id', '=', 'si.store_id')
            ->leftjoin('stores_leagues as sl', 's.id', '=', 'sl.store_id')
            ->leftjoin('leagues as l', function ($query) {
                $query->on('sl.league_id', '=', 'l.id');
            })
            ->where('s.id', '=', $id)
            ->select('s.*', 'si.image1', 'si.cover_image1', 'si.image2', 'si.cover_image2', 'si.image3', 'si.cover_image3', 'sh.mon_open', 'sh.mon_close', 'sh.tue_open', 'sh.tue_close', 'sh.wed_open', 'sh.wed_close', 'sh.thu_open', 'sh.thu_close', 'sh.fri_open', 'sh.fri_close', 'sh.sat_open', 'sh.sat_close', 'sh.sun_open', 'sh.sun_close', 'l.name as league')
            ->get();

        return $store;
    }
}