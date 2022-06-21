<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class Systeme extends Model implements Authenticatable
{
    use BasicAuthenticatable;
    protected $fillable = ['nom', 'prenom','email','motdepasse'];


    public function getAuthPassword()
    {
        return $this->motdepasse;
    }
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }
}
