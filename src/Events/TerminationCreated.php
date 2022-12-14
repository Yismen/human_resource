<?php

namespace Dainsys\HumanResource\Events;

use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Events\Dispatchable;

class TerminationCreated
{
    use Dispatchable;
    use SerializesModels;

    public Termination $termination;

    public function __construct(Termination $termination)
    {
        $this->termination = $termination->load(['employee', 'terminationType', 'terminationReason']);
    }
}
