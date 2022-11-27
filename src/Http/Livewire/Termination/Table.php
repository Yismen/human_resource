<?php

namespace Dainsys\HumanResource\Http\Livewire\Termination;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Termination;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Services\EmployeeService;
use Dainsys\HumanResource\Services\TerminationTypeService;
use Dainsys\HumanResource\Services\TerminationReasonService;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Termination';
    protected $listeners = [
        'terminationUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Termination::query()
            ->with([
                'employee',
                'terminationType',
                'terminationReason',
            ])
            // ->withCount('terminationType')
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Date')
                ->sortable()
                ->searchable(),
            Column::make('Employee', 'employee_id')
                ->format(fn ($value, $row) => $row->employee->full_name),
            Column::make('Type', 'termination_type_id')
                ->format(fn ($value, $row) => $row->terminationType->name),
            Column::make('Reason', 'termination_reason_id')
                ->format(fn ($value, $row) => $row->terminationReason->name),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Type')
                ->options(['' => 'All'] + TerminationTypeService::list()->all())
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('termination_type_id', $value);
                }),
            SelectFilter::make('Reason')
                ->options(['' => 'All'] + TerminationReasonService::list()->all())
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('termination_reason_id', $value);
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
        $this->setDefaultSort('date', 'desc');
    }
}
