<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToDepartment
{
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
