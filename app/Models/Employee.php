<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'father_name',
        'phone_number',
        'relative_phone_number',
        'permanent_address',
        'present_address',
        'district',
        'date_of_joining',
        'date_of_leaving',
        'employee_code',
        'registration_fee'
    ];

    protected $dates = [
        'date_of_joining',
        'date_of_leaving'
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function advances()
    {
        return $this->hasMany(AdvancePayment::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($employee) {
            $employee->employee_code = 'EMP' . str_pad(static::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }

}
