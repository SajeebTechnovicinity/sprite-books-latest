<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Cashier\Billable;


class Author extends Model
{
    use HasFactory, Billable;
    
    protected $guarded = [];  

    protected $table = 'author';

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    public function userMembershipPlan(){
        return $this->hasOne(AuthorMembershipPlan::class);
    }
}
