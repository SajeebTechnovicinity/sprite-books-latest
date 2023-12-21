<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookDocuments;
use App\Models\Settings\Genere;

class Book extends Model
{
    use HasFactory;
    protected $table = "books";
    public function bookDocuments(){
        return $this->hasMany(BookDocuments::class,'book_id','id');
    }

    public function bookAuthor(){
        return $this->belongsTo(Author::class,'author_id','id');
    }

    public function Genere(){
        return $this->belongsTo(Genere::class,'genere_id','id');
    }

}
