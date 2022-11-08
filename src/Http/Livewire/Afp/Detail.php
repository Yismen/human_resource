<?php

namespace Dainsys\HumanResource\Http\Livewire\Afp;

use Livewire\Component;
use Dainsys\HumanResource\Models\Afp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showAfp',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showAfpDetailModal';

    public $afp;

    public function render()
    {
        return view('human_resource::livewire.afp.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showAfp(Afp $afp)
    {
        $this->authorize('view', $afp);

        $this->editing = false;
        $this->afp = $afp;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
