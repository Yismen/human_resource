<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\TerminationType;

class TerminationTypeService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('termination_types_list', function () {
            return TerminationType::orderBy('name')->pluck('name', 'id');
        });
    }
}
