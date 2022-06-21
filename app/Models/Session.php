<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'user_id','ip_address','user_agent','payload','last_activity','created_at','updated_at','role'
    ];

    protected $table = 'sessions';
}
