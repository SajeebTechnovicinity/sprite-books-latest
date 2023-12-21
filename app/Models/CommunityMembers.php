<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMembers extends Model
{
    use HasFactory;
    protected $table = 'community_members';

    public function Follower(){
        return $this->belongsTo(Author::class,'joined_by','id');
    }

    public function Community(){
        return $this->belongsTo(Community::class,'community_id','id');
    }

    public function JoinedAuthor(){
        return $this->belongsTo(Author::class,'joined_author_id','id');
    }
}
