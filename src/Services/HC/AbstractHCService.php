<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Dainsys\HumanResource\Services\Traits\HasFilters;

abstract class AbstractHCService implements HCContract
{
    use HasFilters;

    protected Builder $query;

    protected array $filters = [];

    public function __construct()
    {
        $this->query = $this->builder();
    }

    abstract protected function model(): Model;

    public function count(): Collection
    {
        return Cache::rememberForever(
            $this->cacheKey('hc_count_by_'),
            function () {
                $builder = $this->parseFilters($this->filters, $this->query)
                    ->withCount(['employees' => fn ($q) => $q->notInactive()])
                    ->get();

                return $builder;
            }
        );
    }

    public function list(): Collection
    {
        return Cache::rememberForever(
            $this->cacheKey('hc_list_by_'),
            function () {
                $builder = $this->parseFilters($this->filters, $this->query)
                    ->with(['employees' => fn ($q) => $q->notInactive()])
                    ->get();

                return $builder;
            }
        );
    }

    public function constrain($callback): self
    {
        return $this;
    }

    protected function builder(): Builder
    {
        return $this->model()
            ->groupBy('name')
            ->orderBy('name')
            ->select(['name', 'id'])
            ->whereHas('employees', function ($query) {
                $query->notInactive();
            });
    }

    protected function cacheKey(string $type): string
    {
        $class = get_class($this->model());

        $name = str($class)->replace('\\', ' ')->snake();

        $filters = join('-', $this->filters);

        return "{$type}_{$name}_{$filters}";
    }
}
