<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'fonction',
        'nom_entreprise',
        'ice',
        'phone',
        'email',
        'password',
        'adresse',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}