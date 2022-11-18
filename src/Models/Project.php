<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\ProjectFactory;

class Project extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
