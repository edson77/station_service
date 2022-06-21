<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    protected $table = "bons";
    protected $fillable = ['status','identifiant','categorie','date_bon','localite','nom','montant','libelle'];
    public $timestamps = false;
}
