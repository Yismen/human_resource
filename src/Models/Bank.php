<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\BankFactory;
use Dainsys\HumanResource\Models\Traits\HasManyEmployees;

class Bank extends AbstractModel
{
    use HasInformation;
    use HasManyEmployees;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): BankFactory
    {
        return BankFactory::new();
    }
}
