<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\Employee;

class IssuesService
{
    protected array $ites = [];

    public function handle()
    {
        $this->items['missing_information_count'] = Cache::rememberForever('missing_information_count', fn () => Employee::whereDoesntHave('information')->notInactive()->count());
        $this->items['missing_supervisor_count'] = Cache::rememberForever('missing_supervisor_count', fn () => Employee::whereDoesntHave('supervisor')->notInactive()->count());
        $this->items['missing_afp_count'] = Cache::rememberForever('missing_afp_count', fn () => Employee::whereDoesntHave('afp')->notInactive()->count());
        $this->items['missing_ars_count'] = Cache::rememberForever('missing_ars_count', fn () => Employee::whereDoesntHave('ars')->notInactive()->count());

        return $this->items;
    }
}
