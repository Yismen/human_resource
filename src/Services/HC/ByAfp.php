<?php

namespace Dainsys\HumanResource\Services\HC;

use Dainsys\HumanResource\Models\Afp;
use Illuminate\Database\Eloquent\Model;

class ByAfp extends AbstractHCService
{
    protected function model(): Model
    {
        return new Afp();
    }
}
