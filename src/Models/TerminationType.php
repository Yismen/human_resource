<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\TerminationTypeFactory;

class TerminationType extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): TerminationTypeFactory
    {
        return TerminationTypeFactory::new();
    }
}
