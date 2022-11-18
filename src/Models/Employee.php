<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\EmployeeFactory;

class Employee extends AbstractModel
{
    use HasInformation;

    protected $fillable = ['first_name', 'second_firt_name', 'last_name', 'second_last_name', 'full_name', 'personal_id', 'hired_at', 'date_of_birth', 'cellphone', 'status', 'marriage', 'gender', 'kids'];

    protected static function newFactory(): EmployeeFactory
    {
        return EmployeeFactory::new();
    }
}
