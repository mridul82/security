<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_sub_category_id', 
        'name', 
        'quantity', 
        'type'  // 'employee' or 'client'
    ];

    public function subCategory()
    {
        return $this->belongsTo(InventorySubCategory::class);
    }

    public function stockIssuances()
    {
        return $this->hasMany(StockIssuance::class);
    }
}
