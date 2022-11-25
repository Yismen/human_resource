<?php

namespace Dainsys\HumanResource\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Dainsys\HumanResource\Database\Factories\PositionFactory;

class Position extends AbstractModel
{
    protected $fillable = ['name', 'department_id', 'payment_type_id', 'salary', 'description'];

    protected static function newFactory(): PositionFactory
    {
        return PositionFactory::new();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
