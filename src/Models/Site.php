<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasImages;
use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\SiteFactory;

class Site extends AbstractModel
{
    use HasInformation;
    use HasImages;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): SiteFactory
    {
        return SiteFactory::new();
    }
}
