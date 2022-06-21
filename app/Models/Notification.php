<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table="notifications";
    protected $fillable=["message","received","send","unread","created_at","updated_at"];
}
