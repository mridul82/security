<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'amount',
        'date',
        'status'  // pending, deducted
    ];

    protected $dates = ['date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
