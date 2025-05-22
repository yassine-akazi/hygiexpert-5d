<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Le guard utilisé pour l’authentification.
     */
    protected $guard = 'client';

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

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}