<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\TerminationReasonFactory;

class TerminationReason extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): TerminationReasonFactory
    {
        return TerminationReasonFactory::new();
    }
}
