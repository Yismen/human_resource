<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\PositionFactory;

class Position extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['name', 'department_id', 'payment_type_id', 'salary', 'description'];

    protected static function newFactory(): PositionFactory
    {
        return PositionFactory::new();
    }
}
