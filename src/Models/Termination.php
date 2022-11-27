<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Models\Traits\BelongsToEmployee;
use Dainsys\HumanResource\Database\Factories\TerminationFactory;
use Dainsys\HumanResource\Models\Traits\BelongsToTerminationType;
use Dainsys\HumanResource\Models\Traits\BelongsToTerminationReason;

class Termination extends AbstractModel
{
    use BelongsToEmployee;
    use BelongsToTerminationType;
    use BelongsToTerminationReason;

    protected $fillable = ['employee_id', 'date', 'termination_type_id', 'termination_reason_id', 'comments', 'rehireable'];

    protected static function booted()
    {
        parent::booted();

        static::created(function ($termination) {
            $termination->employee->status = EmployeeStatus::INACTIVE;

            $termination->employee->saveQuietly();
        });
    }

    protected static function newFactory(): TerminationFactory
    {
        return TerminationFactory::new();
    }
}
