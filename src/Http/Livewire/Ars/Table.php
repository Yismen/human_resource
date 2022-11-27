<?php

namespace Dainsys\HumanResource\Http\Livewire\Ars;

use Dainsys\HumanResource\Models\Ars;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Ars';
    protected $listeners = [
        'arsUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Ars::query()
            ->with(['information'])
            ->withCount([
                'employees'
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Photo', 'id')
                ->view('human_resource::tables.thumbnail'),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Phone', 'information.phone')
                ->label(fn ($row) => optional($row->information)->phone),
            Column::make('Email')
                ->label(fn ($row) => optional($row->information)->email),
            Column::make('Employees', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
