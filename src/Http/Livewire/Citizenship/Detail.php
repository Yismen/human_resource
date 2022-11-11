<?php

namespace Dainsys\HumanResource\Http\Livewire\Citizenship;

use Livewire\Component;
use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showCitizenship',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showCitizenshipDetailModal';

    public $citizenship;

    public function render()
    {
        return view('human_resource::livewire.citizenship.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showCitizenship(Citizenship $citizenship)
    {
        $this->authorize('view', $citizenship);

        $this->editing = false;
        $this->citizenship = $citizenship;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
