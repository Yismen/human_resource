<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationType;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createTerminationType',
        'updateTerminationType',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showTerminationTypeFormModal';

    public $terminationtype;

    protected function getRules()
    {
        return [
            'terminationtype.name' => [
                'required',
                Rule::unique(tableName('termination_types'), 'name')->ignore($this->terminationtype->id ?? 0)
            ],
            'terminationtype.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.termination_type.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createTerminationType()
    {
        $this->terminationtype = new TerminationType();
        $this->authorize('create', $this->terminationtype);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateTerminationType(TerminationType $terminationtype)
    {
        $this->terminationtype = $terminationtype;
        $this->authorize('update', $this->terminationtype);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new TerminationType());
        $this->validate();

        $this->editing = false;

        $this->terminationtype->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('terminationtypeUpdated');

        flashMessage('TerminationType created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->terminationtype);
        $this->validate();

        $this->terminationtype->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('TerminationType Updated!', 'warning');

        $this->editing = false;

        $this->emit('terminationtypeUpdated');
    }
}
