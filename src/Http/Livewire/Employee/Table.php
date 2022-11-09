<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Employee';
    protected $listeners = [
        'employeeUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Employee::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('employeeType')
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
