<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Support\Enums\Gender;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Exports\EmployeesExport;
use Dainsys\HumanResource\Support\Enums\MaritalStatus;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
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
        return Employee::query()
            ->with(['information']);
    }

    public function columns(): array
    {
        return [
            Column::make('Photo', 'id')
                ->view('human_resource::tables.thumbnail'),
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
                ->view('human_resource::statuses')
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

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options(array_merge(['' => 'All'], EmployeeStatus::all()))
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
            SelectFilter::make('Gender')
                ->options(array_merge(['' => 'All'], Gender::all()))
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('gender', $value);
                }),
            SelectFilter::make('Has Kids')
                ->options(array_merge(['' => 'All'], [
                    '1' => 'Yes',
                    '0' => 'No',
                ]))
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('kids', $value);
                }),
            SelectFilter::make('Marriage')
                ->options(array_merge(
                    ['' => 'All'],
                    MaritalStatus::all()
                ))
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('marriage', $value);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }

    public function export()
    {
        $employees = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new EmployeesExport($employees), 'employees.xlsx');
    }
}
