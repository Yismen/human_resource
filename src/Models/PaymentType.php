<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasManyPositions;
use Dainsys\HumanResource\Database\Factories\PaymentTypeFactory;

class PaymentType extends AbstractModel
{
    use HasManyPositions;
    
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): PaymentTypeFactory
    {
        return PaymentTypeFactory::new();
    }
}
