<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatToken extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'admin_id',
        'client_id',
        'order_code',
        'is_active',
    ];
}
