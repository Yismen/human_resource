<?php

namespace Dainsys\HumanResource\Services\HC;

use Dainsys\HumanResource\Models\Site;
use Illuminate\Database\Eloquent\Model;

class BySite extends AbstractHCService
{
    protected function model(): Model
    {
        return new Site();
    }
}
