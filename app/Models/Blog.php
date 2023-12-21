<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'author_id',
        'usertype',
        'blog_name',
        'blog_short_description',
        'blog_full_description',
        'blog_image'
    ];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
