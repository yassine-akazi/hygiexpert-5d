<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',   // ex: pdf_path, plan_path, etc.
        'path',   // chemin relatif vers le fichier stocké
    ];

    /**
     * Relation avec le client (un document appartient à un client)
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}