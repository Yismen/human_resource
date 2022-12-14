<?php

namespace Dainsys\HumanResource\Services;

use Dainsys\HumanResource\Models\Employee;

class EmployeesNeedingSuspension implements ServicesContract
{
    public static function list()
    {
        return Employee::current()->hasActiveSuspension()->get();
    }
}
