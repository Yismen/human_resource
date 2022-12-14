<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Database\Eloquent\Model;
use Dainsys\HumanResource\Models\Position;

class ByPosition extends AbstractHCService
{
    protected function model(): Model
    {
        return new Position();
    }
}
