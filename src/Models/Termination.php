<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\TerminationFactory;

class Termination extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['employee_id', 'date', 'termination_type_id', 'termination_reason_id', 'comments', 'rehireable'];

    protected static function newFactory(): TerminationFactory
    {
        return TerminationFactory::new();
    }
}
