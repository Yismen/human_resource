<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\TerminationReasonFactory;

class TerminationReason extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): TerminationReasonFactory
    {
        return TerminationReasonFactory::new();
    }
}
