<?php

namespace Dainsys\HumanResource\Http\Livewire\Supervisor;

use Livewire\Component;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showSupervisor',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showSupervisorDetailModal';

    public $supervisor;

    public function render()
    {
        return view('human_resource::livewire.supervisor.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showSupervisor(Supervisor $supervisor)
    {
        $this->authorize('view', $supervisor);

        $this->editing = false;
        $this->supervisor = $supervisor;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
