<?php

namespace Dainsys\HumanResource\Http\Livewire\Termination;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Termination;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Models\TerminationReason;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dainsys\HumanResource\Services\TerminationTypeService;
use Dainsys\HumanResource\Services\TerminationReasonService;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createTermination',
        'updateTermination',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showTerminationFormModal';

    public $termination;

    public function render()
    {
        return view('human_resource::livewire.termination.form', [
            'termination_types' => TerminationTypeService::list(),
            'termination_reasons' => TerminationReasonService::list(),
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createTermination()
    {
        $this->termination = new Termination();
        $this->authorize('create', $this->termination);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateTermination(Termination $termination)
    {
        $this->termination = $termination;
        $this->authorize('update', $this->termination);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Termination());
        $this->validate();

        $this->editing = false;

        $this->termination->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('terminationUpdated');

        flashMessage('Termination created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->termination);
        $this->validate();

        $this->termination->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Termination Updated!', 'warning');

        $this->editing = false;

        $this->emit('terminationUpdated');
    }

    protected function getRules()
    {
        return [
            'termination.employee_id' => [
                'required',
                Rule::exists(Employee::class, 'id')
            ],
            'termination.date' => [
                'required',
                'date',
            ],
            'termination.termination_type_id' => [
                'required',
                Rule::exists(TerminationType::class, 'id'),
            ],
            'termination.termination_reason_id' => [
                'required',
                Rule::exists(TerminationReason::class, 'id')
            ],
            'termination.rehireable' => [
                'required',
                'boolean'
            ],
            'termination.comments' => [
                'nullable',
            ],
        ];
    }
}
