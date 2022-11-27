<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySuspensions
{
    public function suspensions(): HasMany
    {
        return $this->hasMany(Suspension::class);
    }
}
