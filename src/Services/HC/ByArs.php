<?php

namespace Dainsys\HumanResource\Services\HC;

use Dainsys\HumanResource\Models\Ars;
use Illuminate\Database\Eloquent\Model;

class ByArs extends AbstractHCService
{
    protected function model(): Model
    {
        return new Ars();
    }
}
