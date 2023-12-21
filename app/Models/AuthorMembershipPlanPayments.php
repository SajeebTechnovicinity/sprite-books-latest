<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorMembershipPlanPayments extends Model
{
    use HasFactory;

    public function MembershipPlan(){
        return $this->belongsTo(MembershipPlan::class,'membership_plan_id','id');
    }

    public function Author(){
        return $this->belongsTo(Author::class,'author_id','id');
    }
}
