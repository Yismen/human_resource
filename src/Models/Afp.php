<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\AfpFactory;
use Dainsys\HumanResource\Models\Traits\HasManyEmployees;

class Afp extends AbstractModel
{
    use HasInformation;
    use HasManyEmployees;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): AfpFactory
    {
        return AfpFactory::new();
    }
}
