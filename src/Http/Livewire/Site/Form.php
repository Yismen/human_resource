<?php

namespace Dainsys\HumanResource\Http\Livewire\Site;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Site;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createSite',
        'updateSite',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showSiteFormModal';

    public $site;

    protected function getRules()
    {
        return [
            'site.name' => [
                'required',
                Rule::unique(tableName('sites'), 'name')->ignore($this->site->id ?? 0)
            ],
            'site.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.site.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createSite()
    {
        $this->site = new Site();
        $this->authorize('create', $this->site);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateSite(Site $site)
    {
        $this->site = $site;
        $this->authorize('update', $this->site);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Site());
        $this->validate();

        $this->editing = false;

        $this->site->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('siteUpdated');

        flashMessage('Site created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->site);
        $this->validate();

        $this->site->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Site Updated!', 'warning');

        $this->editing = false;

        $this->emit('siteUpdated');
    }
}
