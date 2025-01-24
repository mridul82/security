<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'amount',
        'effective_date',
        'previous_amount',
        'increment_amount'
    ];

    protected $dates = ['effective_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
