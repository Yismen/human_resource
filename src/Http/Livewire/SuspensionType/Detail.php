<?php

namespace Dainsys\HumanResource\Http\Livewire\SuspensionType;

use Livewire\Component;
use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showSuspensionType',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showSuspensionTypeDetailModal';

    public $suspension_type;

    public function render()
    {
        return view('human_resource::livewire.suspension_type.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showSuspensionType(SuspensionType $suspension_type)
    {
        $this->authorize('view', $suspension_type);

        $this->editing = false;
        $this->suspension_type = $suspension_type;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
