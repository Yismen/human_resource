<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Ars;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToArs
{
    public function ars(): BelongsTo
    {
        return $this->belongsTo(Ars::class);
    }
}
