<?php

namespace Dainsys\HumanResource\Events;

use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Events\Dispatchable;

class EmployeeCreated
{
    use Dispatchable;
    use SerializesModels;

    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee->load([
            'site',
            'project',
        ]);
    }
}
