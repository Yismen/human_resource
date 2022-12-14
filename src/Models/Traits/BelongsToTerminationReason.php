<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTerminationReason
{
    public function terminationReason(): BelongsTo
    {
        return $this->belongsTo(TerminationReason::class);
    }
}
