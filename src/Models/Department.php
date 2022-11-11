<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\DepartmentFactory;

class Department extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): DepartmentFactory
    {
        return DepartmentFactory::new();
    }
}
