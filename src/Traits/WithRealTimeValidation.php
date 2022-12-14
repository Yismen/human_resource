<?php

namespace Dainsys\HumanResource\Traits;

trait WithRealTimeValidation
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
