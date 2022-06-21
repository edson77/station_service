<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    protected $table = "voitures";
    protected $fillable = ['immatriculation','marque','modele','typeCarburant', 'idUser'];
    public $timestamps=false;
}
