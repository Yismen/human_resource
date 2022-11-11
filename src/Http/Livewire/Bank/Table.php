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
        'bankUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Bank::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('bankType')
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
