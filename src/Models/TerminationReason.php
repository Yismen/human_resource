<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyTerminations;
use Dainsys\HumanResource\Database\Factories\TerminationReasonFactory;

class TerminationReason extends AbstractModel
{
    use HasManyTerminations;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): TerminationReasonFactory
    {
        return TerminationReasonFactory::new();
    }
}
