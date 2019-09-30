<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details', 'overview', 'original_price', 'percentage_off', 'amount_off', 'new_price', 'start_date', 'end_date', 'start_time', 'end_time', 'redeem_code', 'active', 'approved', 'store_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get created at attribute
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(config('constants.default-timezone'))->format('Y-m-d H:i:s');
    }

    /**
     * Get updated at attribute
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(config('constants.default-timezone'))->format('Y-m-d H:i:s');
    }

    /**
     * Get deleted at attribute
     * @param $value
     * @return null|string
     */
    public function getDeletedAtAttribute($value)
    {
        if (is_null($value))
            return null;
        else
            return Carbon::parse($value)->setTimezone(config('constants.default-timezone'))->format('Y-m-d H:i:s');
    }

    /**
     * Get the store belongs to deal.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * Get the days associated with the deal.
     */
    public function days()
    {
        return $this->hasOne('App\DealDays');
    }

    /**
     * Get the images associated with the deal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->hasOne('App\DealImages');
    }

    /**
     * Get the category associated with the deal.
     */
    public function category()
    {
        return $this->belongsToMany('App\Category','deals_categories')->withTimestamps();
    }
}
