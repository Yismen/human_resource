<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEmployees
{
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
