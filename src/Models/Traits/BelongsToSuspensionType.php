<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToSuspensionType
{
    public function suspensionType(): BelongsTo
    {
        return $this->belongsTo(SuspensionType::class);
    }
}
