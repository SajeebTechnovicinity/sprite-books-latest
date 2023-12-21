<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorFollower extends Model
{
    use HasFactory;

    protected $table = 'author_followers';

    public function followerUser(){
        return $this->belongsTo(Author::class,'user_id','id');
    }

    public function Author(){
        return $this->belongsTo(Author::class,'author_id','id');
    }

    public function followedByAuthor(){
        return $this->belongsTo(Author::class,'followed_author_id','id');
    }
}
