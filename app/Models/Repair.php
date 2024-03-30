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
    protected $fillable = ['description', 'status', 'startDate', 'endDate', 'mechanicNotes', 'clientNotes', 'mechanicID', 'vehicleID'];

    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanicID');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function spairParts()
    {
        return $this->belongsToMany(SpairPart::class, 'repair_spare_part', 'repair_id', 'spare_part_id')
        ->withPivot('quantity', 'unit_price');
    }
}
