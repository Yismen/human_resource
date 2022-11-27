<?php

namespace Dainsys\HumanResource\Events;

use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Events\Dispatchable;

class SuspensionCreated
{
    use Dispatchable;
    use SerializesModels;

    public Suspension $suspension;

    public function __construct(Suspension $suspension)
    {
        $this->suspension = $suspension->load(['employee', 'suspensionType']);
    }
}
