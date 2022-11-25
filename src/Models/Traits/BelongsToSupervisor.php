<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToSupervisor
{
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }
}
