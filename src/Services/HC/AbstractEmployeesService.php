<?php

namespace Dainsys\HumanResource\Services\HC;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractEmployeesService implements HCContract
{
    protected $value;

    protected string $field;

    protected string $name;

    public function __construct()
    {
        $class = get_class($this);

        $this->name = str($class)->replace('\\', ' ')->snake();
        $this->field = $this->field();
    }

    abstract protected function field(): string;

    public function count($value = null): Collection
    {
        $this->value = $value;

        return $this->builder()
            ->addSelect(DB::raw("{$this->field} as name"))
            ->groupBy($this->field)
            ->selectRaw('count(*) as employees_count')
            ->get();
    }

    public function list($value = null): Collection
    {
        $this->value = $value;

        return $this->builder()
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
