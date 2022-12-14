<?php

namespace Dainsys\HumanResource\Listeners;

use Dainsys\HumanResource\Events\TerminationCreated;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

class TerminateEmployee
{
    public function handle(TerminationCreated $event)
    {
        $event->termination->employee->updateQuietly(['status' => EmployeeStatus::INACTIVE]);
    }
}
