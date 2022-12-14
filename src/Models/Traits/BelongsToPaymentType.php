<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToPaymentType
{
    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
}
