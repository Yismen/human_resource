<?php

namespace Dainsys\HumanResource\Http\Livewire\Termination;

use Dainsys\HumanResource\Models\Termination;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
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
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('terminationType')
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
