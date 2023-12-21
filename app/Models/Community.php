<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;


    protected $table = "communities";

    public function communityAuthor(){
        return $this->belongsTo(Author::class,'author_id','id');
    }
}
