<?php

namespace Dainsys\HumanResource\Http\Livewire\Suspension;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Suspension;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Services\EmployeeService;
use Dainsys\HumanResource\Services\SuspensionTypeService;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Suspension';
    protected $listeners = [
        'suspensionUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Suspension::query()
            ->with([
                'employee',
                'suspensionType',
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Starts At')
                ->format(fn ($value, $row) => $row->starts_at->format('Y-m-d'))
                ->sortable()
                ->searchable(),
            Column::make('Ends At')
                ->format(fn ($value, $row) => $row->ends_at->format('Y-m-d'))
                ->sortable()
                ->searchable(),
            Column::make('Duration', 'ends_at')
                ->format(fn ($value, $row) => $row->duration),
            Column::make('Type', 'suspension_type_id')
                ->format(fn ($value, $row) => $row->suspensionType->name),
            Column::make('Employee', 'employee_id')
                ->format(fn ($value, $row) => $row->employee->full_name),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Type')
                ->options(['' => 'All'] + SuspensionTypeService::list()->all())
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('suspension_type_id', $value);
                }),
            SelectFilter::make('Employee')
                ->options(['' => 'All'] + EmployeeService::list()->all())
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('employee_id', $value);
                }),
        ];
    }

    protected function withDefaultSorting()
    {
        $this->setDefaultSort('ends_at', 'desc');
    }
}
