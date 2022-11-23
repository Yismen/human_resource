<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationType;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createTerminationType',
        'updateTerminationType',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showTerminationTypeFormModal';

    public $termination_type;

    protected function getRules()
    {
        return [
            'termination_type.name' => [
                'required',
                Rule::unique(tableName('termination_types'), 'name')->ignore($this->termination_type->id ?? 0)
            ],
            'termination_type.description' => [
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
        $this->termination_type = new TerminationType();
        $this->authorize('create', $this->termination_type);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateTerminationType(TerminationType $termination_type)
    {
        $this->termination_type = $termination_type;
        $this->authorize('update', $this->termination_type);
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

        $this->termination_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('termination_typeUpdated');

        flashMessage('TerminationType created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->termination_type);
        $this->validate();

        $this->termination_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('TerminationType Updated!', 'warning');

        $this->editing = false;

        $this->emit('termination_typeUpdated');
    }
}
