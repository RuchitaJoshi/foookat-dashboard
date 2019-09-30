<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealImages extends Model
{
    protected $table = 'deals_images';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'image1', 'cover_image1', 'image2', 'cover_image2', 'image3', 'cover_image3'
    ];

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
     * Get the deal belongs to image.
     */
    public function store()
    {
        return $this->belongsTo('App\Deal');
    }
}
