<?php

namespace Dainsys\HumanResource\Http\Livewire\Citizenship;

use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Citizenship';
    protected $listeners = [
        'citizenshipUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Citizenship::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('citizenshipType')
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
