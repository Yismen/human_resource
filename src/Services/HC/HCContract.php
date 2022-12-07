<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Database\Eloquent\Collection;

interface HCContract
{
    public function count($value = null): Collection;

    public function list($value = null): Collection;
}
