<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyEmployees;
use Dainsys\HumanResource\Database\Factories\CitizenshipFactory;

class Citizenship extends AbstractModel
{
    use HasManyEmployees;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): CitizenshipFactory
    {
        return CitizenshipFactory::new();
    }
}
