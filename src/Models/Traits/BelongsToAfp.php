<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Afp;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToAfp
{
    public function afp(): BelongsTo
    {
        return $this->belongsTo(Afp::class);
    }
}
