<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\SuspensionFactory;

class Suspension extends AbstractModel
{
    protected $fillable = ['employee_id', 'suspension_type_id', 'starts_at', 'ends_at', 'comments'];

    protected static function newFactory(): SuspensionFactory
    {
        return SuspensionFactory::new();
    }
}