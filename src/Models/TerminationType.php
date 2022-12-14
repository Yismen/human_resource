<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyTerminations;
use Dainsys\HumanResource\Database\Factories\TerminationTypeFactory;

class TerminationType extends AbstractModel
{
    use HasManyTerminations;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): TerminationTypeFactory
    {
        return TerminationTypeFactory::new();
    }
}
