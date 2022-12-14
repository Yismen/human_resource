<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Termination ;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Models\TerminationReason;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dainsys\HumanResource\Services\TerminationTypeService;
use Dainsys\HumanResource\Services\TerminationReasonService;

class Terminate extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    public bool $editing = false;

    public $employee;
    public $termination;

    protected $listeners = [
        'updateEmployee' => 'init'
    ];

    public function render()
    {
        return view('human_resource::livewire.employee.terminate', [
            'termination_types' => TerminationTypeService::list(),
            'termination_reasons' => TerminationReasonService::list(),
        ]);
    }

    public function mount($employee)
    {
        $this->init();
        $this->employee = $employee;
        $this->editing = false;
    }

    public function prepare()
    {
        $this->init();
        $this->termination = new Termination([
            'employee_id' => $this->employee->id,
            'rehireable' => true,
        ]);

        $this->authorize('create', $this->termination);

        $this->resetValidation();
        $this->editing = true;
    }

    public function store()
    {
        $this->authorize('create', new Termination());
        $this->validate();

        $this->termination->save();

        $this->emit('employeeUpdated');

        flashMessage('Employee terminated!', 'danger');
        $this->editing = false;
        $this->emit('updateEmployee', $this->employee->id);
    }

    public function init()
    {
        $this->reset(['termination', 'editing']);
    }

    protected function getRules()
    {
        return [
            'termination.date' => [
                'required',
                'date',
            ],
            'termination.employee_id' => [
                'required',
                Rule::exists(Employee::class, 'id'),
            ],
            'termination.termination_type_id' => [
                'required',
                Rule::exists(TerminationType::class, 'id'),
            ],
            'termination.termination_reason_id' => [
                'required',
                Rule::exists(TerminationReason::class, 'id'),
            ],
            'termination.rehireable' => [
                'required',
                'boolean',
            ],
            'termination.comments' => [
                'nullable',
                'max:5000'
            ],
        ];
    }
}
