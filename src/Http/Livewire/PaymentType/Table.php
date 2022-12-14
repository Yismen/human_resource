<?php

namespace Dainsys\HumanResource\Http\Livewire\PaymentType;

use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\PaymentType;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\HumanResource\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'PaymentType';
    protected $listeners = [
        'payment_typeUpdated' => '$refresh'
    ];

    public function builder(): Builder
    {
        return PaymentType::query()
            ->withCount([
                'positions'
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Employees', 'id')
                ->format(fn ($value, $row) => view('human_resource::tables.badge')->with(['value' => $row->positions_count])),
            Column::make('Actions', 'id')
                ->view('human_resource::tables.actions'),
        ];
    }
}
