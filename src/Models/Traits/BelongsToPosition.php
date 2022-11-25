<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Position;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPosition
{
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
