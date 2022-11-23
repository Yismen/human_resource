<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\EmployeeFactory;

class Employee extends AbstractModel
{
    use HasInformation;

    public static function booted()
    {
        static::saving(function ($employee) {
            $employee->full_name = trim(
                join(' ', array_filter([
                    $employee->first_name,
                    $employee->second_first_name,
                    $employee->last_name,
                    $employee->second_last_name,
                ]))
            );

            $employee->saveQuietly();
        });
    }

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
        'hired_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['first_name', 'second_first_name', 'last_name', 'second_last_name', 'full_name', 'personal_id', 'hired_at', 'date_of_birth', 'cellphone', 'status', 'marriage', 'gender', 'kids'];

    protected static function newFactory(): EmployeeFactory
    {
        return EmployeeFactory::new();
    }
}
