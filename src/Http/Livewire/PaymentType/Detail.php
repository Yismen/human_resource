<?php

namespace Dainsys\HumanResource\Http\Livewire\PaymentType;

use Livewire\Component;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showPaymentType',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showPaymentTypeDetailModal';

    public $payment_type;

    public function render()
    {
        return view('human_resource::livewire.payment_type.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showPaymentType(PaymentType $payment_type)
    {
        $this->authorize('view', $payment_type);

        $this->editing = false;
        $this->payment_type = $payment_type;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
