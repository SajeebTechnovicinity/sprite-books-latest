<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'membership_plan_name',
        'membership_plan_slug',
        'membership_plan_stripe_plan',
        'membership_plan_monthly_price',
        'membership_plan_yearly_price',
        'max_no_of_books',
        'max_no_of_events',
        'max_no_of_video_promotion',
        'max_author_account',
        'membership_plan_description',
        'membership_plan_status',
        'created_at',
        'updated_at',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function getRouteKeyName()
    {
        return 'membership_plan_slug';
    }
}
