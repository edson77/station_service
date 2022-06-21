<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citerne extends Model
{
    protected $table= "citerne";
    protected $fillable = ['typeCarburant','montant','date_livraison','type_carburant','quantiteLivree','compagnie'];
    public $timestamps = false;
}
