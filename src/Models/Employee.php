<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\BelongsToAfp;
use Dainsys\HumanResource\Models\Traits\BelongsToArs;
use Dainsys\HumanResource\Models\Traits\BelongsToSite;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Models\Traits\BelongsToProject;
use Dainsys\HumanResource\Models\Traits\BelongsToPosition;
use Dainsys\HumanResource\Models\Traits\BelongsToSupervisor;
use Dainsys\HumanResource\Database\Factories\EmployeeFactory;
use Dainsys\HumanResource\Models\Traits\BelongsToCitizenship;
use Dainsys\HumanResource\Models\Traits\BelongsToDepartmentThruPosition;

class Employee extends AbstractModel
{
    use HasInformation;
    use BelongsToSite;
    use BelongsToProject;
    use BelongsToPosition;
    use BelongsToCitizenship;
    use BelongsToSupervisor;
    use BelongsToAfp;
    use BelongsToArs;
    use BelongsToDepartmentThruPosition;

    public static function booted()
    {
        parent::booted();

        static::saving(function ($employee) {
            $employee->full_name = trim(
                join(' ', array_filter([
                    $employee->first_name,
                    $employee->second_first_name,
                    $employee->last_name,
                    $employee->second_last_name,
                ]))
            );

            $employee->saveQuietly();
        });
    }

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
        'hired_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = ['first_name', 'second_first_name', 'last_name', 'second_last_name', 'full_name', 'personal_id', 'hired_at', 'date_of_birth', 'cellphone', 'status', 'marriage', 'gender', 'kids', 'site_id', 'project_id', 'position_id', 'citizenship_id', 'supervisor_id', 'afp_id', 'ars_id'];

    protected static function newFactory(): EmployeeFactory
    {
        return EmployeeFactory::new();
    }
}
