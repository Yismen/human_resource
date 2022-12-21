<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Events\SuspensionUpdated;
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

    protected static function newFactory(): SuspensionFactory
    {
        return SuspensionFactory::new();
    }

    public function getDurationAttribute()
    {
        return $this->starts_at ? $this->starts_at->diffInDays($this->ends_at) + 1 . ' days' : null;
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

    public function getIsActiveAttribute(): bool
    {
        return  now()->isBetween($this->starts_at->startOfDay(), $this->ends_at->endOfDay());
    }
}
