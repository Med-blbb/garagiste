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
    protected $fillable = ['repair_id', 'client_id', 'additionalCharges', 'totalAmount'];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class , 'client_id');
    }
}
