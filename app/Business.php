<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'city', 'state', 'zip_code', 'type', 'description', 'active'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get created at attribute
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(config('constants.default-timezone'))->format('Y-m-d H:i:s');
    }

    /**
     * Get deleted at attribute
     */
    public function getDeletedAtAttribute($value)
    {
        if (is_null($value))
            return null;
        else
            return Carbon::parse($value)->setTimezone(config('constants.default-timezone'))->format('Y-m-d H:i:s');
    }

    /**
     * Get the users associated with the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User','businesses_users_roles')->withPivot('role_id', 'active')->withTimestamps();
    }

    /**
     * Get the stores associated with the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stores()
    {
        return $this->hasMany('App\Store');
    }

    /**
     * Get the membership plan associated with the business.
     */
    public function membershipPlan()
    {
        return $this->belongsToMany('App\MembershipPlan','businesses_plans')->withTimestamps();
    }
}
