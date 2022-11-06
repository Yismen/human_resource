<?php

namespace Dainsys\HumanResource\Http\Livewire\Site;

use Livewire\Component;
use Dainsys\HumanResource\Models\Site;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showSite',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showSiteDetailModal';

    public $site;

    public function render()
    {
        return view('human_resource::livewire.site.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showSite(Site $site)
    {
        $this->authorize('view', $site);

        $this->editing = false;
        $this->site = $site;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
