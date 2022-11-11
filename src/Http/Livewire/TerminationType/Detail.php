<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationType;

use Livewire\Component;
use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showTerminationType',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showTerminationTypeDetailModal';

    public $termination_type;

    public function render()
    {
        return view('human_resource::livewire.termination_type.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showTerminationType(TerminationType $termination_type)
    {
        $this->authorize('view', $termination_type);

        $this->editing = false;
        $this->termination_type = $termination_type;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
