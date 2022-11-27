<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyEmployees;
use Dainsys\HumanResource\Models\Traits\HasManyPositions;
use Dainsys\HumanResource\Database\Factories\DepartmentFactory;
use Dainsys\HumanResource\Models\Traits\HasManyEmployeesThruPositions;

class Department extends AbstractModel
{
    use HasManyPositions;
    use HasManyEmployeesThruPositions;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): DepartmentFactory
    {
        return DepartmentFactory::new();
    }
}
