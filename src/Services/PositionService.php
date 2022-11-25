<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Position;

class PositionService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('positions_list', function () {
            return Position::orderBy('name')->pluck('name', 'id');
        });
    }
}
