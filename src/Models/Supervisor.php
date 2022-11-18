<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\SupervisorFactory;

class Supervisor extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SupervisorFactory
    {
        return SupervisorFactory::new();
    }
}
