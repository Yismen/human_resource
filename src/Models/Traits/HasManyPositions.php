<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Position;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyPositions
{
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}
