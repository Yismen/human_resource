<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationType;

use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'TerminationType';
    protected $listeners = [
        'termination_typeUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return TerminationType::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('termination_typeType')
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
