<?php

namespace Dainsys\HumanResource\Http\Livewire\PaymentType;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createPaymentType',
        'updatePaymentType',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showPaymentTypeFormModal';

    public $payment_type;

    protected function getRules()
    {
        return [
            'payment_type.name' => [
                'required',
                Rule::unique(tableName('payment_types'), 'name')->ignore($this->payment_type->id ?? 0)
            ],
            'payment_type.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.payment_type.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createPaymentType()
    {
        $this->payment_type = new PaymentType();
        $this->authorize('create', $this->payment_type);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updatePaymentType(PaymentType $payment_type)
    {
        $this->payment_type = $payment_type;
        $this->authorize('update', $this->payment_type);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new PaymentType());
        $this->validate();

        $this->editing = false;

        $this->payment_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('payment_typeUpdated');

        flashMessage('PaymentType created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->payment_type);
        $this->validate();

        $this->payment_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('PaymentType Updated!', 'warning');

        $this->editing = false;

        $this->emit('payment_typeUpdated');
    }
}
