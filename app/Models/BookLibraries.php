<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLibraries extends Model
{
    use HasFactory;

    protected $table = 'book_libraries';

    public function followerUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function Book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }

    public function AddedAuthor(){
        return $this->belongsTo(Author::class,'added_author_id','id');
    }

}
