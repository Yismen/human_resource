<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\AfpFactory;

class Afp extends AbstractModel
{
    use HasInformation;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): AfpFactory
    {
        return AfpFactory::new();
    }
}
