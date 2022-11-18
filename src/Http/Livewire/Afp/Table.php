<?php

namespace Dainsys\HumanResource\Http\Livewire\Afp;

use Dainsys\HumanResource\Models\Afp;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Afp';

    protected $listeners = [
        'afpUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Afp::query()
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
