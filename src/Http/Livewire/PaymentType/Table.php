<?php

namespace Dainsys\HumanResource\Http\Livewire\PaymentType;

use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Database\Eloquent\Builder;
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
            ->select(['name', 'id'])
            // ->withCount('products')
            // ->withCount('sales')
            // ->withCount('payment_typeType')
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
