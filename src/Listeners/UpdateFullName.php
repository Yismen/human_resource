<?php

namespace Dainsys\HumanResource\Listeners;

use Dainsys\HumanResource\Events\EmployeeSaved;

class UpdateFullName
{
    public function handle(EmployeeSaved $event)
    {
        $event->employee->updateFullName();
    }
}
