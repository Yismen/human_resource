<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCitizenship
{
    public function citizenship(): BelongsTo
    {
        return $this->belongsTo(Citizenship::class);
    }
}
