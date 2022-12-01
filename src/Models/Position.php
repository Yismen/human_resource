<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyEmployees;
use Dainsys\HumanResource\Models\Traits\BelongsToDepartment;
use Dainsys\HumanResource\Database\Factories\PositionFactory;
use Dainsys\HumanResource\Models\Traits\BelongsToPaymentType;

class Position extends AbstractModel
{
    use HasManyEmployees;
    use BelongsToDepartment;
    use BelongsToPaymentType;

    protected $fillable = ['name', 'department_id', 'payment_type_id', 'salary', 'description'];

    protected static function newFactory(): PositionFactory
    {
        return PositionFactory::new();
    }

    public function setSalaryAttribute($salary)
    {
        $this->attributes['salary'] = floor($salary * 100);
    }

    public function getSalaryAttribute($salary)
    {
        return $salary / 100;
    }
}
