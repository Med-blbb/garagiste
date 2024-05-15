<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['description', 'status', 'start_date', 'end_date', 'mechanic_notes', 'client_notes', 'mechanic_id', 'vehicle_id','spair_id'];

    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
    public function spairParts()
    {
        return $this->hasMany(SpairPart::class);
    }
    
}

