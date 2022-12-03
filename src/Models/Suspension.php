<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Events\SuspensionCreated;
use Dainsys\HumanResource\Events\SuspensionUpdated;
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

    protected $dispatchesEvents = [
        'saved' => SuspensionUpdated::class,
    ];

    public function getDurationAttribute()
    {
        return $this->starts_at ? $this->starts_at->diffInDays($this->ends_at) + 1 . ' days' : null;
    }

    protected static function newFactory(): SuspensionFactory
    {
        return SuspensionFactory::new();
    }

    public function scopeActive($query)
    {
        $query->where(function ($query) {
            $query
                ->whereDate('starts_at', '<=', now()->format('Y-m-d'))
                ->whereDate('ends_at', '>=', now()->format('Y-m-d'))
                ;
        });
    }

    // public function changeEmployeeStatus()
    // {
    //     // dd($this->employee->toArray(), $this->toArray());
    //     if ($this->shouldSuspend()) {
    //         dd('suspend', $this->employee->toArray(), $this->toArray());
    //         $this->employee->update([
    //             'status' => EmployeeStatus::SUSPENDED,
    //         ]);
    //     }
    //     if ($this->shouldRemoveSuspension()) {
    //         dd('unsuspend', $this->employee->toArray(), $this->toArray());
    //         $this->employee->update([
    //             'status' => EmployeeStatus::CURRENT,
    //         ]);
    //     }
    // }

    // protected function shouldSuspend(): bool
    // {
    //     $date = now();

    //     if ($this->employee->status === EmployeeStatus::INACTIVE) {
    //         dd('aqui');
    //         return false;
    //     }

    //     if ($date < $this->starts_at) {
    //         return false;
    //     }

    //     if ($date > $this->ends_at) {
    //         return false;
    //     }

    //     return true;
    // }

    // protected function shouldRemoveSuspension(): bool
    // {
    //     $date = now();

    //     if ($this->employee->status !== EmployeeStatus::SUSPENDED) {
    //         return false;
    //     }

    //     if ($date < $this->starts_at) {
    //         return true;
    //     }

    //     if ($date > $this->ends_at) {
    //         return true;
    //     }

    //     return false;
    // }
}
