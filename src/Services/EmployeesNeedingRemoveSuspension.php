<?php

namespace Dainsys\HumanResource\Services;

use Dainsys\HumanResource\Models\Employee;

class EmployeesNeedingRemoveSuspension implements ServicesContract
{
    public static function list()
    {
        return Employee::suspended()->missingActiveSuspension()->get();
    }
}
