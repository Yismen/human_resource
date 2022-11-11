<?php

namespace Dainsys\HumanResource\Http\Livewire\Ars;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Ars;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createArs',
        'updateArs',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showArsFormModal';

    public $ars;

    protected function getRules()
    {
        return [
            'ars.name' => [
                'required',
                Rule::unique(tableName('arss'), 'name')->ignore($this->ars->id ?? 0)
            ],
            'ars.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.ars.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createArs()
    {
        $this->ars = new Ars();
        $this->authorize('create', $this->ars);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateArs(Ars $ars)
    {
        $this->ars = $ars;
        $this->authorize('update', $this->ars);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Ars());
        $this->validate();

        $this->editing = false;

        $this->ars->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('arsUpdated');

        flashMessage('Ars created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->ars);
        $this->validate();

        $this->ars->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Ars Updated!', 'warning');

        $this->editing = false;

        $this->emit('arsUpdated');
    }
}
