<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Database\Factories\PaymentTypeFactory;

class PaymentType extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): PaymentTypeFactory
    {
        return PaymentTypeFactory::new();
    }
}
