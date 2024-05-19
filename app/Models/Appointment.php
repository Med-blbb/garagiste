<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = "appointments";

    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'date',
        'time',
    ];

   
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
