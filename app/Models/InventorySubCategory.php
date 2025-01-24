<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventorySubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_category_id', 
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    public function products()
    {
        return $this->hasMany(InventoryProduct::class);
    }
}
