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
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Phone', 'information.phone')
                ->label(fn ($row) => optional($row->information)->phone),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
