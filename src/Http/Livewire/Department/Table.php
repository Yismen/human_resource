<?php

namespace Dainsys\HumanResource\Http\Livewire\Department;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Department;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Department';
    protected $listeners = [
        'departmentUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Department::query()
            ->withCount([
                'employees',
                'positions'
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Positions', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->positions_count])),
            Column::make('Employees', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
