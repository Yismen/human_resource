<?php

namespace Dainsys\HumanResource\Listeners;

use Dainsys\HumanResource\Events\SuspensionUpdated;

class SuspendEmployee
{
    public function handle(SuspensionUpdated $event)
    {
        $employee = $event->suspension->employee;
        if ($employee->shouldBeSuspended()) {
            $employee->suspend();
        }
        if ($employee->shouldNotBeSuspended()) {
            $employee->unsuspend();
        }
    }
}
