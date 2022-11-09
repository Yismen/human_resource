<?php

namespace Dainsys\HumanResource\Http\Livewire\SuspensionType;

use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'SuspensionType';
    protected $listeners = [
        'suspension_typeUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return SuspensionType::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('suspension_typeType')
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
