<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'overview', 'address', 'city', 'state', 'zip_code', 'latitude', 'longitude', 'email', 'mobile_number' ,'phone_number', 'business_id', 'note', 'active', 'approved'
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
     * Get the business belongs to store.
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * Get the hours associated with the store.
     */
    public function hours()
    {
        return $this->hasOne('App\StoreHours');
    }

    /**
     * Get the images associated with the store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->hasOne('App\StoreImages');
    }

    /**
     * Get the league associated with the store.
     */
    public function league()
    {
        return $this->belongsToMany('App\League','stores_leagues')->withTimestamps();
    }

    /**
     * Get the deals associated with the store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function deals()
    {
        return $this->hasMany('App\Deal');
    }
}
