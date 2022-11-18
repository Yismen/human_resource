<?php

namespace Dainsys\HumanResource\Models;

use Dainsys\HumanResource\Models\Traits\HasInformation;
use Dainsys\HumanResource\Database\Factories\ArsFactory;

class Ars extends AbstractModel
{
    use HasInformation;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): ArsFactory
    {
        return ArsFactory::new();
    }

    public function getTable(): string
    {
        return tableName('arss');
    }
}
