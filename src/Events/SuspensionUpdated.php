<?php

namespace Dainsys\HumanResource\Events;

use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Events\Dispatchable;

class SuspensionUpdated
{
    use Dispatchable;
    use SerializesModels;

    public Suspension $suspension;

    public function __construct(Suspension $suspension)
    {
        $this->suspension = $suspension->load([
            'employee' => fn ($q) => $q->with(['site', 'project', 'position']),
            'suspensionType'
        ]);
    }
}
