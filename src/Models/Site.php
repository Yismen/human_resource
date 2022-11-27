<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\SiteFactory;
use Dainsys\HumanResource\Models\Traits\HasManyEmployees;

class Site extends AbstractModel
{
    use HasInformation;
    use HasManyEmployees;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SiteFactory
    {
        return SiteFactory::new();
    }
}
