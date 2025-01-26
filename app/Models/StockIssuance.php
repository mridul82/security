<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIssuance extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_product_id', 
        'quantity', 
        'issued_to_type',  // 'employee' or 'client'
        'issued_to_id',    // ID of employee or client
        'issued_at'   
    ];

    public function product()
    {
        return $this->belongsTo(InventoryProduct::class);
    }
}
