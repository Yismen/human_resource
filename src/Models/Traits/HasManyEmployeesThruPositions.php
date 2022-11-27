<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Position;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasManyEmployeesThruPositions
{
    public function employees(): HasManyThrough
    {
        return $this->hasManyThrough(Employee::class, Position::class);
    }
}
