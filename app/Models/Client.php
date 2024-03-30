<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'phoneNumber',
        'user_id', // Clé étrangère vers le modèle User
    ];

    public function user()
    {
        return $this->belongsTo(User::class ,'UserID');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
