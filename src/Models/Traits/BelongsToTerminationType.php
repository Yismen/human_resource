<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTerminationType
{
    public function terminationType(): BelongsTo
    {
        return $this->belongsTo(TerminationType::class);
    }
}
