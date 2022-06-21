<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "client";
    protected $fillable = ['nom','telephone','grade','Fonction'];
    public $timestamps =false;
}
