<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Project;

class ProjectService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('projects_list', function () {
            return Project::orderBy('name')->pluck('name', 'id');
        });
    }
}
