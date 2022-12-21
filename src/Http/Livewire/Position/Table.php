<?php

namespace Dainsys\HumanResource\Http\Livewire\Position;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Position;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Services\DepartmentService;
use Dainsys\HumanResource\Services\PaymentTypeService;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Position';
    protected $listeners = [
        'positionUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Position::query()
            ->with([
                'department',
                'paymentType',
            ])
            ->withCount('employees')
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Department', 'department_id')
                ->format(fn ($value, $row) => $row->department->name),
            Column::make('Type', 'payment_type_id')
                ->format(fn ($value, $row) => $row->paymentType->name),
            Column::make('Salary')
            ->format(fn ($value) => "\${$value}")
                ->sortable()
                ->searchable(),
            Column::make('Employees', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Department')
                ->options(['' => 'All'] + DepartmentService::list()->toArray())
                ->filter(
                    function (Builder $builder, int $department) {
                        $builder->where('department_id', $department);
                    }
                ),
            SelectFilter::make('PaymentType')
                ->options(['' => 'All'] + PaymentTypeService::list()->toArray())
                ->filter(
                    function (Builder $builder, int $payment_type) {
                        $builder->where('payment_type_id', $payment_type);
                    }
                ),
        ];
    }
}
