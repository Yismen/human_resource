<?php

namespace Dainsys\HumanResource\Http\Livewire\Citizenship;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Citizenship;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Citizenship';
    protected $listeners = [
        'citizenshipUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Citizenship::query()
            ->withCount([
                'employees'
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Employees', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
