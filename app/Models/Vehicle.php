<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'make',
        'model',
        'fuelType',
        'registration',
        'photos',
        'client_id', // Clé étrangère vers le modèle Client
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
