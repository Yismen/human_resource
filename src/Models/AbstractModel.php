<?php

namespace Dainsys\HumanResource\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbstractModel extends Model
{
    use HasFactory;

    public function getTable(): string
    {
        return tableName(str(get_class($this))->afterLast('\\')->plural()->snake()->lower());
    }
}
