<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\SuspensionTypeFactory;

class SuspensionType extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SuspensionTypeFactory
    {
        return SuspensionTypeFactory::new();
    }
}
