<?php

namespace Dainsys\HumanResource\Listeners;

use Dainsys\HumanResource\Events\SuspensionCreated;

class SuspendEmployee
{
    public function handle(SuspensionCreated $event)
    {
        $event->suspension->changeEmployeeStatus();
    }
}
