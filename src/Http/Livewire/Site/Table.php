<?php

namespace Dainsys\HumanResource\Http\Livewire\Site;

use Dainsys\HumanResource\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Site';
    protected $listeners = [
        'siteUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return Site::query()
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('siteType')
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
