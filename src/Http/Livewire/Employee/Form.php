<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Support\Enums\Gender;
use Dainsys\HumanResource\Support\Enums\MaritalStatus;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createEmployee',
        'updateEmployee',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showEmployeeFormModal';

    public $employee;

    protected function getRules()
    {
        return [
            'employee.first_name' => [
                'required',
            ],
            'employee.second_firt_name' => [
                'required',
            ],
            'employee.last_name' => [
                'required',
            ],
            'employee.second_last_name' => [
                'required',
            ],
            'employee.full_name' => [
                'nullable',
            ],
            'employee.personal_id' => [
                'required',
                'min:10',
                'max:11'
            ],
            'employee.hired_at' => [
                'required',
                'date',
            ],
            'employee.date_of_birth' => [
                'required',
                'date',
            ],
            'employee.cellphone' => [
                'required',
            ],
            'employee.status' => [
                'required',
                Rule::in((new EmployeeStatus())->all()),
            ],
            'employee.marriage' => [
                'required',
                Rule::in((new MaritalStatus())->all()),
            ],
            'employee.gender' => [
                'required',
                Rule::in((new Gender())->all()),
            ],
            'employee.kids' => [
                'required',
                'boolean',
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.employee.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createEmployee()
    {
        $this->employee = new Employee();
        $this->authorize('create', $this->employee);
        $this->editing = false;
        
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateEmployee(Employee $employee)
    {
        $this->employee = $employee;
        $this->authorize('update', $this->employee);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Employee());
        $this->validate();

        $this->editing = false;

        $this->employee->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('employeeUpdated');

        flashMessage('Employee created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->employee);
        $this->validate();

        $this->employee->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Employee Updated!', 'warning');

        $this->editing = false;

        $this->emit('employeeUpdated');
    }
}
