<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'numero','recettes','depenses','date_jour','caissier','id_consommation','id_recharge'
    ];

    protected $table = 'transactions';
    public $timestamps = false;
}
