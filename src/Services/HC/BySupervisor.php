<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Database\Eloquent\Model;
use Dainsys\HumanResource\Models\Supervisor;

class BySupervisor extends AbstractHCService
{
    protected function model(): Model
    {
        return new Supervisor();
    }
}
