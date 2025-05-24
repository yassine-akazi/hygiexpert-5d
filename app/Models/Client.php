<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

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
        // si tu veux rendre last_seen modifiable manuellement :
        'last_seen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_seen' => 'datetime',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}