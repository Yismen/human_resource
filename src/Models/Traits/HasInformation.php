<?php

namespace Dainsys\HumanResource\Models\Traits;

use Dainsys\HumanResource\Models\Information;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasInformation
{
    public function information(): MorphOne
    {
        return $this->morphOne(Information::class, 'informationable');
    }
}
