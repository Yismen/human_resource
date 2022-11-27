<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToEmployee
{
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
