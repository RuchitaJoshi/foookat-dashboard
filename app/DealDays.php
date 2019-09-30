<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealDays extends Model
{
    protected $table = 'deals_recurrences';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deal_id', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'
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
     * Get the deal belongs to deal days.
     */
    public function deal()
    {
        return $this->belongsTo('App\Deal');
    }
}
