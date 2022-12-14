<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyEmployees;
use Dainsys\HumanResource\Database\Factories\ProjectFactory;

class Project extends AbstractModel
{
    use HasManyEmployees;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
