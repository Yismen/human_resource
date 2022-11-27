<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Models\Traits\HasManyEmployees;
use Dainsys\HumanResource\Database\Factories\SupervisorFactory;

class Supervisor extends AbstractModel
{
    use HasManyEmployees;
    use HasInformation;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SupervisorFactory
    {
        return SupervisorFactory::new();
    }
}
