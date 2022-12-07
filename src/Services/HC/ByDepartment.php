<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Database\Eloquent\Model;
use Dainsys\HumanResource\Models\Department;

class ByDepartment extends AbstractHCService
{
    protected function model(): Model
    {
        return new Department();
    }
}
