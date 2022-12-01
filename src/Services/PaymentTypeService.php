<?php

namespace Dainsys\HumanResource\Services;

use Illuminate\Support\Facades\Cache;
use Dainsys\HumanResource\Models\PaymentType;

class PaymentTypeService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('payment_type_list', function () {
            return PaymentType::orderBy('name')->pluck('name', 'id');
        });
    }
}
