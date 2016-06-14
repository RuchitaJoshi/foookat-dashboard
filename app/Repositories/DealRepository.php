<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DealRepository
{
    /**
     * Get deals
     *
     * @param $store_id
     * @return mixed
     */
    public function getDeals($store_id)
    {
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');
        $current_day = strtolower(date("D", strtotime($current_date)));
        $deals = DB::table('deals as d')
            ->leftjoin('deals_recurrences as dr', 'd.id', '=', 'dr.deal_id')
            ->leftjoin('deals_images as di', 'd.id', '=', 'di.deal_id')
            ->leftjoin('deals_categories as dc', 'd.id', '=', 'dc.deal_id')
            ->leftjoin('categories as c', function ($query) {
                $query->on('dc.category_id', '=', 'c.id');
            })
            ->where('d.store_id', '=', $store_id)
            ->orderBy('d.created_at', 'desc')
            ->select('d.*', 'di.image1', 'di.cover_image1', 'di.image2', 'di.cover_image2', 'di.image3', 'di.cover_image3', 'dr.mon', 'dr.tue', 'dr.wed', 'dr.thu', 'dr.fri', 'dr.sat', 'dr.sun', 'c.name as category')
            ->paginate(10);
        foreach ($deals as $deal) {
            if ($deal->start_date <= $current_date && $deal->end_date >= $current_date && $deal->start_time <= $current_time && $deal->end_time >= $current_time && $deal->$current_day == 1) {
                $deal->status = 'Live Now';
            } else {
                $deal->status = 'Offline';
            }
        }
        return $deals;
    }

    /**
     * Get deal
     *
     * @param $deal_id
     * @return mixed
     */
    public function getDeal($deal_id)
    {
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');
        $current_day = strtolower(date("D", strtotime($current_date)));
        $deal = DB::table('deals as d')
            ->leftjoin('deals_recurrences as dr', 'd.id', '=', 'dr.deal_id')
            ->leftjoin('deals_images as di', 'd.id', '=', 'di.deal_id')
            ->leftjoin('deals_categories as dc', 'd.id', '=', 'dc.deal_id')
            ->leftjoin('categories as c', function ($query) {
                $query->on('dc.category_id', '=', 'c.id');
            })
            ->where('d.id', '=', $deal_id)
            ->select('d.*', 'di.image1', 'di.cover_image1', 'di.image2', 'di.cover_image2', 'di.image3', 'di.cover_image3', 'dr.mon', 'dr.tue', 'dr.wed', 'dr.thu', 'dr.fri', 'dr.sat', 'dr.sun', 'c.name as category')
            ->first();

        if ($deal->start_date <= $current_date && $deal->end_date >= $current_date && $deal->start_time <= $current_time && $deal->end_time >= $current_time && $deal->$current_day == 1) {
            $deal->status = 'Live Now';
        } else {
            $deal->status = 'Offline';
        }

        return $deal;
    }
}