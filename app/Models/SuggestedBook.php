<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }
}
