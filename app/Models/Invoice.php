<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['repair_id', 'client_id', 'additional_charges','amount', 'total_amount'];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class , 'client_id');
    }
    public function spareParts()
    {
        return $this->belongsToMany(SpairPart::class, 'invoice_spare_parts', 'invoice_id', 'spair_part_id');
    }
}
