<?php
// app/Models/ContactMessage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'message'];
    public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}
}