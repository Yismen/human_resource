<?php

namespace Dainsys\HumanResource\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToDepartmentThruPosition
{
    public function department(): BelongsTo
    {
        return $this->position->department();
    }
}
