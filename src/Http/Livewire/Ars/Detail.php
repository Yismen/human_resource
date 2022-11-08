<?php

namespace Dainsys\HumanResource\Http\Livewire\Ars;

use Livewire\Component;
use Dainsys\HumanResource\Models\Ars;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showArs',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showArsDetailModal';

    public $ars;

    public function render()
    {
        return view('human_resource::livewire.ars.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showArs(Ars $ars)
    {
        $this->authorize('view', $ars);

        $this->editing = false;
        $this->ars = $ars;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
