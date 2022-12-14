<?php

namespace Dainsys\HumanResource\Services\HC;

class ByStatus extends AbstractEmployeesService
{
    protected function field(): string
    {
        return 'status';
    }
}
