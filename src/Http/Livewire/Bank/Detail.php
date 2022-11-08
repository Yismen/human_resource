<?php

namespace Dainsys\HumanResource\Http\Livewire\Bank;

use Livewire\Component;
use Dainsys\HumanResource\Models\Bank;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showBank',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showBankDetailModal';

    public $bank;

    public function render()
    {
        return view('human_resource::livewire.bank.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showBank(Bank $bank)
    {
        $this->authorize('view', $bank);

        $this->editing = false;
        $this->bank = $bank;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
