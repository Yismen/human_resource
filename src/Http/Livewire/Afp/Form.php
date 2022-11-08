<?php

namespace Dainsys\HumanResource\Http\Livewire\Afp;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Afp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createAfp',
        'updateAfp',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showAfpFormModal';

    public $afp;

    protected function getRules()
    {
        return [
            'afp.name' => [
                'required',
                Rule::unique(tableName('afps'), 'name')->ignore($this->afp->id ?? 0)
            ],
            'afp.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.afp.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createAfp()
    {
        $this->afp = new Afp();
        $this->authorize('create', $this->afp);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateAfp(Afp $afp)
    {
        $this->afp = $afp;
        $this->authorize('update', $this->afp);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Afp());
        $this->validate();

        $this->editing = false;

        $this->afp->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('afpUpdated');

        flashMessage('Afp created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->afp);
        $this->validate();

        $this->afp->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Afp Updated!', 'warning');

        $this->editing = false;

        $this->emit('afpUpdated');
    }
}
