<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

class EmployeesNotInactiveService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('employees_not_inactive_list', function () {
            return Employee::query()
                ->where('status', '<>', EmployeeStatus::INACTIVE)
                ->orderBy('full_name')
                ->pluck('full_name', 'id');
        });
    }
}
