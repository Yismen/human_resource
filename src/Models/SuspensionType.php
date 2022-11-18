<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\SuspensionTypeFactory;

class SuspensionType extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SuspensionTypeFactory
    {
        return SuspensionTypeFactory::new();
    }
}
