<?php

namespace Dainsys\HumanResource\Events;

use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class EmployeeSaved
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
}
