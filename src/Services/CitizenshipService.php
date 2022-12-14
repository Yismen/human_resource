<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Citizenship;

class CitizenshipService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('citizenships_list', function () {
            return Citizenship::orderBy('name')->pluck('name', 'id');
        });
    }
}
