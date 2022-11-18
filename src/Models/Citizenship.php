<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\CitizenshipFactory;

class Citizenship extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): CitizenshipFactory
    {
        return CitizenshipFactory::new();
    }
}
