<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpairPart extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['partName', 'partReference', 'supplier', 'price'];
    public function repairs()
    {
        return $this->belongsToMany(Repair::class, 'repair_spare_part', 'spare_part_id', 'repair_id')
        ->withPivot('quantity');
    }
}
