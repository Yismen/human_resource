<?php

namespace Dainsys\HumanResource\Http\Livewire\Supervisor;

use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Supervisor';
    protected $listeners = [
        'supervisorUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Supervisor::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('supervisorType')
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
