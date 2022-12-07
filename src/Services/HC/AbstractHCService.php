<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractHCService implements HCContract
{
    protected $value;

    protected string $name;

    public function __construct()
    {
        $class = get_class($this->model());

        $this->name = str($class)->replace('\\', ' ')->snake();
    }

    abstract protected function model(): Model;

    public function count($value = null): Collection
    {
        $this->value = $value;

        return Cache::rememberForever(
            'hc_count_by_' . $this->name . '_' . $this->value,
            function () {
                return $builder = self::builder()
                    ->withCount(['employees' => fn ($q) => $q->notInactive()])
                    ->get();
            }
        );
    }

    public function list($value = null): Collection
    {
        $this->value = $value;

        return Cache::rememberForever(
            'hc_list_by_' . $this->name . '_' . $this->value,
            function () {
                return $builder = self::builder()
                    ->with(['employees' => fn ($q) => $q->notInactive()])
                    ->get();
            }
        );
    }

    protected function builder(): Builder
    {
        return $this->model()
            ->groupBy('name')
            ->orderBy('name')
            ->select(['name', 'id'])
            ->when($this->value, function ($query) {
                $query->when(
                    is_numeric($this->value),
                    fn ($q) => $q->where('id', (int)$this->value),
                    fn ($q) => $q->where('name', 'like', $this->value)
                );
            })
            ->whereHas('employees', function ($query) {
                $query->notInactive();
            });
    }
}
