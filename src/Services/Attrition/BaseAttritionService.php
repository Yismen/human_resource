<?php

namespace Dainsys\HumanResource\Services\Attrition;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseAttritionService implements AttritionContract
{
    protected Carbon $date_from;

    protected Carbon $date_to;

    public function __construct(Carbon $date_from = null, Carbon $date_to = null)
    {
        $this->date_from = $date_from ?: now();
        $this->date_to = $date_to ?: now();
    }

    abstract protected function query(): Builder;

    public function count(): int
    {
        return Cache::rememberForever($this->getCacheKey(__FUNCTION__), function () {
            return $this->query()->count();
        });
    }

    public function list(): Collection
    {
        return Cache::rememberForever($this->getCacheKey(__FUNCTION__), function () {
            return $this->query()->get();
        });
    }

    protected function getCacheKey(string $method): string
    {
        return str(get_class($this))
            ->replace('\\', ' ')
            ->lower()
            ->snake()
             . "_{$method}_"
             . $this->date_from->format('Y-m-d')
             . '_'
             . $this->date_to->format('Y-m-d');
    }
}
