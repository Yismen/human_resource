<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationReason;

use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'TerminationReason';
    protected $listeners = [
        'termination_reasonUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return TerminationReason::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('termination_reasonType')
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
