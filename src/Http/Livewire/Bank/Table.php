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
            ->select(['name', 'id'])
            ->with(['information'])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Phone')
                ->label(fn ($row) => optional($row->information)->phone),
            Column::make('Email')
                ->label(fn ($row) => optional($row->information)->email),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
