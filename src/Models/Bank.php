<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\BankFactory;

class Bank extends AbstractModel
{
    use HasInformation;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): BankFactory
    {
        return BankFactory::new();
    }
}
