<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Database\Eloquent\Model;
use Dainsys\HumanResource\Models\Project;

class ByProject extends AbstractHCService
{
    protected function model(): Model
    {
        return new Project();
    }
}
