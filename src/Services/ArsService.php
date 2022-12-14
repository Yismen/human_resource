<?php

namespace Dainsys\HumanResource\Services;

use Dainsys\HumanResource\Models\Ars;
use Illuminate\Support\Facades\Cache;

class ArsService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('arss_list', function () {
            return Ars::orderBy('name')->pluck('name', 'id');
        });
    }
}
