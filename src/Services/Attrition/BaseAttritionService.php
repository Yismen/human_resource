<?php

namespace Dainsys\HumanResource\Services\Attrition;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Dainsys\HumanResource\Services\Traits\HasFilters;

abstract class BaseAttritionService implements AttritionContract
{
    use HasFilters;

    protected Carbon $date_from;
    protected Carbon $date_to;
    protected array $filters;

    public function __construct(Carbon $date_from = null, Carbon $date_to = null, array $filters = [])
    {
        $this->date_from = $date_from ?: now();
        $this->date_to = $date_to ?: now();
        $this->filters = $filters;
    }

    abstract protected function query(): Builder;

    public function count(): int
    {
        return Cache::rememberForever($this->getCacheKey(__FUNCTION__), function () {
            $query = $this->parseFilters($this->filters, $this->query());

            return $query->count();
        });
    }

    public function list(): Collection
    {
        return Cache::rememberForever($this->getCacheKey(__FUNCTION__), function () {
            $query = $this->parseFilters($this->filters, $this->query());

            return $query->get();
        });
    }

    protected function getCacheKey(string $method): string
    {
        $name = join('_', [
            str(get_class($this))->replace('\\', ' ')->lower()->snake(),
            "{$method}",
            $this->date_from->format('Y-m-d'),
            $this->date_to->format('Y-m-d'),
            join('_', array_keys($this->filters)),
            join('_', $this->filters),
        ]);

        return $name;
    }
}
