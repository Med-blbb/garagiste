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
    protected $fillable = ['part_name', 'part_reference', 'supplier', 'price', 'quantity','repair_id'];
    public function repair()
{
    return $this->belongsTo(Repair::class);
}
public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_spare_parts', 'spair_part_id', 'invoice_id');
    }

}
