<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Employee;

class EmployeeService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('employees_list', function () {
            return Employee::orderBy('full_name')->pluck('full_name', 'id');
        });
    }
}
