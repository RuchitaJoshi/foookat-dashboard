<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipPlan extends Model
{
    protected $table = 'membership_plans';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details', 'amount'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the businesses that has a membership plan.
     */
    public function businesses()
    {
        return $this->belongsToMany('App\Business','businesses_plans')->withTimestamps();
    }
}
