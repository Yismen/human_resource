<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Models\Traits\BelongsToEmployee;
use Dainsys\HumanResource\Database\Factories\SuspensionFactory;
use Dainsys\HumanResource\Models\Traits\BelongsToSuspensionType;

class Suspension extends AbstractModel
{
    use BelongsToEmployee;
    use BelongsToSuspensionType;

    protected $fillable = ['employee_id', 'suspension_type_id', 'starts_at', 'ends_at', 'comments'];

    protected $casts = [
        'starts_at' => 'date:Y-m-d',
        'ends_at' => 'date:Y-m-d',
    ];

    protected static function newFactory(): SuspensionFactory
    {
        return SuspensionFactory::new();
    }

    protected static function booted()
    {
        parent::booted();

        static::saved(function ($suspension) {
            $suspension->changeEmployeeStatus();
        });
    }

    public function changeEmployeeStatus()
    {
        if ($this->shouldSuspend()) {
            $this->employee->update([
                'status' => EmployeeStatus::SUSPENDED,
            ]);
        }
        if ($this->shouldRemoveSuspension()) {
            $this->employee->update([
                'status' => EmployeeStatus::CURRENT,
            ]);
        }
    }

    protected function shouldSuspend(): bool
    {
        $date = now();

        if ($this->employee->status === EmployeeStatus::INACTIVE) {
            return false;
        }

        if ($date < $this->starts_at) {
            return false;
        }

        if ($date > $this->ends_at) {
            return false;
        }

        return true;
    }

    protected function shouldRemoveSuspension(): bool
    {
        $date = now();

        if ($this->employee->status !== EmployeeStatus::SUSPENDED) {
            return false;
        }

        if ($date < $this->starts_at) {
            return true;
        }

        if ($date > $this->ends_at) {
            return true;
        }

        return false;
    }
}
