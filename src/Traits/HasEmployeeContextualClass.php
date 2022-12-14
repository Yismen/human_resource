<?php

namespace Dainsys\HumanResource\Traits;

use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

trait HasEmployeeContextualClass
{
    protected function titleClass(): string
    {
        switch ($this->employee->status ?? '') {
            case EmployeeStatus::CURRENT:
                return 'text-success';
                break;
            case EmployeeStatus::INACTIVE:
                return 'text-danger';
                break;
            case EmployeeStatus::SUSPENDED:
                return 'text-warning';
                break;

            default:
                return '';
                break;
        }
    }
}
