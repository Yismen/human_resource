<?php

namespace Dainsys\HumanResource\Http\Livewire\Suspension;

use Livewire\Component;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showSuspension',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showSuspensionDetailModal';

    public $suspension;

    public function render()
    {
        return view('human_resource::livewire.suspension.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showSuspension(Suspension $suspension)
    {
        $this->authorize('view', $suspension);

        $this->editing = false;
        $this->suspension = $suspension;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
