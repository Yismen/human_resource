<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Site;

class SiteService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('sites_list', function () {
            return Site::orderBy('name')->pluck('name', 'id');
        });
    }
}
