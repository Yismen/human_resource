<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationReason;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createTerminationReason',
        'updateTerminationReason',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showTerminationReasonFormModal';

    public $termination_reason;

    protected function getRules()
    {
        return [
            'termination_reason.name' => [
                'required',
                Rule::unique(tableName('termination_reasons'), 'name')->ignore($this->termination_reason->id ?? 0)
            ],
            'termination_reason.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.termination_reason.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createTerminationReason()
    {
        $this->termination_reason = new TerminationReason();
        $this->authorize('create', $this->termination_reason);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateTerminationReason(TerminationReason $termination_reason)
    {
        $this->termination_reason = $termination_reason;
        $this->authorize('update', $this->termination_reason);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new TerminationReason());
        $this->validate();

        $this->editing = false;

        $this->termination_reason->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('terminationReasonUpdated');

        flashMessage('TerminationReason created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->termination_reason);
        $this->validate();

        $this->termination_reason->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('TerminationReason Updated!', 'warning');

        $this->editing = false;

        $this->emit('terminationReasonUpdated');
    }
}
