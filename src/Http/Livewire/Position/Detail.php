<?php

namespace Dainsys\HumanResource\Http\Livewire\Position;

use Livewire\Component;
use Dainsys\HumanResource\Models\Position;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showPosition',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showPositionDetailModal';

    public $position;

    public function render()
    {
        return view('human_resource::livewire.position.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showPosition(Position $position)
    {
        $this->authorize('view', $position);

        $this->editing = false;
        $this->position = $position;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
