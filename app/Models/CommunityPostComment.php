<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityPostComment extends Model
{
    use HasFactory;

    public function Author(){
        return $this->belongsTo(Author::class,'user_id','id');
    }
}
