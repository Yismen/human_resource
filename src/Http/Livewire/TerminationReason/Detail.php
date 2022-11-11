<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationReason;

use Livewire\Component;
use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showTerminationReason',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showTerminationReasonDetailModal';

    public $termination_reason;

    public function render()
    {
        return view('human_resource::livewire.termination_reason.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showTerminationReason(TerminationReason $termination_reason)
    {
        $this->authorize('view', $termination_reason);

        $this->editing = false;
        $this->termination_reason = $termination_reason;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
