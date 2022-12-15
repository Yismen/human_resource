<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Dainsys\HumanResource\Services\Traits\HasFilters;

abstract class AbstractEmployeesService implements HCContract
{
    use HasFilters;

    protected $value;

    protected Builder $query;

    protected string $field;

    protected array $filters = [];

    public function __construct()
    {
        $this->field = $this->field();
        $this->query = $this->builder();
    }

    abstract protected function field(): string;

    public function count($value = null): Collection
    {
        return $this->parseFilters($this->filters, $this->query)
            ->addSelect(DB::raw("{$this->field} as name"))
            ->groupBy($this->field)
            ->selectRaw('count(*) as employees_count')
            ->get();
    }

    public function list($value = null): Collection
    {
        $this->value = $value;

        return $this->parseFilters($this->filters, $this->query)
            ->orderBy('full_name')
            ->get()
            ->groupBy($this->field);
    }

    protected function builder(): Builder
    {
        return Employee::orderBy($this->field)
            ->when($this->value, fn ($q) => $q->where($this->field, $this->value));
    }
}
