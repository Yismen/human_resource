<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension ;
use Dainsys\HumanResource\Models\SuspensionType;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Dainsys\HumanResource\Services\SuspensionTypeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Suspend extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    public bool $editing = false;

    public $employee;
    public $suspension;

    protected $listeners = [
        'updateEmployee' => 'init'
    ];

    public function render()
    {
        return view('human_resource::livewire.employee.suspend', [
            'suspension_types' => SuspensionTypeService::list(),
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
        $this->suspension = new Suspension([
            'employee_id' => $this->employee->id,
            'rehireable' => true,
        ]);

        $this->authorize('create', $this->suspension);

        $this->resetValidation();
        $this->editing = true;
    }

    public function store()
    {
        $this->authorize('create', new Suspension());
        $this->validate();

        $this->suspension->save();

        $this->emit('employeeUpdated');
        $this->emit('updateEmployee', $this->employee->id);

        flashMessage('Suspension Created!', 'warning');
        $this->editing = false;
    }

    public function init()
    {
        $this->reset(['suspension', 'editing']);
    }

    protected function getRules()
    {
        return [
            'suspension.suspension_type_id' => [
                'required',
                Rule::exists(SuspensionType::class, 'id'),
            ],
            'suspension.starts_at' => [
                'required',
                'date',
                // 'before_or_equal:suspension.ends_at'
            ],
            'suspension.ends_at' => [
                'required',
                'date',
                'after_or_equal:suspension.starts_at'
            ],
            'suspension.employee_id' => [
                'required',
                Rule::exists(Employee::class, 'id'),
            ],
            'suspension.comments' => [
                'nullable',
                'max:5000'
            ],
        ];
    }
}
