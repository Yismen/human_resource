<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\DepartmentFactory;

class Department extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): DepartmentFactory
    {
        return DepartmentFactory::new();
    }
}
