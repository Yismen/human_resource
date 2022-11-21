<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Employee';
    protected $listeners = [
        'employeeUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Employee::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Full Name')
                ->sortable()
                ->searchable(),
            Column::make('Personal Id')
                ->searchable()
                ->sortable(),
            Column::make('Hired At')
                ->searchable()
                ->sortable()
            ->format(fn ($value, $row, Column $column) => $value->format('Y-m-d')),
            Column::make('Cellphone')
                ->searchable()
                ->sortable(),
            Column::make('Status')
                ->searchable()
                ->sortable(),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }

    protected function withDefaultSorting()
    {
        $this->setDefaultSort('first_name', 'asc');
    }
}
