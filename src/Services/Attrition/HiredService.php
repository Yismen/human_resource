<?php

namespace Dainsys\HumanResource\Services\Attrition;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;

class HiredService extends BaseAttritionService
{
    protected function query(): Builder
    {
        return Employee::query()
        // ->forDefaultSites()
        // ->filter(request()->all())
            ->whereDate('hired_at', '>=', $this->date_from)
            ->whereDate('hired_at', '<=', $this->date_to);
    }
}
