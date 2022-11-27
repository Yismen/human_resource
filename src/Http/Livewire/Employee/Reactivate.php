<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Reactivate extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    public bool $editing = false;

    public $employee;
    public $reactivation;

    protected $listeners = [
        'updateEmployee' => 'init'
    ];

    public function render()
    {
        return view('human_resource::livewire.employee.reactivate');
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
        $this->reactivation = [
            'employee_id' => $this->employee->id,
        ];

        $this->authorize('update', $this->employee);

        $this->resetValidation();
        $this->editing = true;
    }

    public function store()
    {
        $this->authorize('update', $this->employee);
        $this->validate();

        $this->employee->update([
            'hired_at' => $this->reactivation['hired_at'],
            'status' => EmployeeStatus::CURRENT,
        ]);

        $this->emit('employeeUpdated');

        flashMessage('Employee reactivated!', 'success');
        $this->editing = false;
        $this->emit('updateEmployee', $this->employee->id);
    }

    public function init()
    {
        $this->reset(['reactivation', 'editing']);
    }

    protected function getRules()
    {
        return [
            'reactivation.hired_at' => [
                'required',
                'date',
            ],
            'reactivation.employee_id' => [
                'required',
                Rule::exists(Employee::class, 'id'),
            ],
        ];
    }
}
