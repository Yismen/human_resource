<?php

namespace Dainsys\HumanResource\Http\Livewire\Suspension;

use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Suspension';
    protected $listeners = [
        'suspensionUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Suspension::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('suspensionType')
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
