<?php

namespace Dainsys\HumanResource\Http\Livewire\Termination;

use Livewire\Component;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showTermination',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showTerminationDetailModal';

    public $termination;

    public function render()
    {
        return view('human_resource::livewire.termination.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showTermination(Termination $termination)
    {
        $this->authorize('view', $termination);

        $this->editing = false;
        $this->termination = $termination;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
