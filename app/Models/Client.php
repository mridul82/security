<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name', 
        'phone_number', 
        'address'
    ];

    public function files()
    {
        return $this->hasMany(ClientFile::class);
    }
}
