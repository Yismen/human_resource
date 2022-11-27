<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Termination;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyTerminations
{
    public function terminations(): HasMany
    {
        return $this->hasMany(Termination::class);
    }
}
