<?php

namespace Dainsys\HumanResource\Services\Attrition;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;

class TerminatedService extends BaseAttritionService
{
    protected function query(): Builder
    {
        return Employee::with('termination')
            ->whereHas('terminations', function ($query) {
                return $query->whereDate('date', '>=', $this->date_from)
                        ->whereDate('date', '<=', $this->date_to);
            });
    }
}
