<?php

namespace Dainsys\HumanResource\Http\Livewire\Bank;

use Dainsys\HumanResource\Models\Bank;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Bank';
    protected $listeners = [
        'bankUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Bank::query()
            ->with(['information'])
            // ->withCount([
            //     'employees'
            // ])
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
            Column::make('Phone')
                ->label(fn ($row) => optional($row->information)->phone),
            Column::make('Email')
                ->label(fn ($row) => optional($row->information)->email),
            // Column::make('Employees', 'id')
            //     ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
