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
}
