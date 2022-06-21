<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consommation extends Model
{
    protected $table = "consommation";
    protected $fillable = ['deleted','date_consomation','quantite_carburant',
        'commentaire','montant_consomation', 'typeCarburant',
        'id_station_service','immatriculation','id_pompe','id_modePayement',
        'id_citerne','id_client','modePayement'];
    public $timestamps =false;
}
