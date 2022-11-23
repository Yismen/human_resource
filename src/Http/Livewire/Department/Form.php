<?php

namespace Dainsys\HumanResource\Http\Livewire\Department;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Department;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createDepartment',
        'updateDepartment',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showDepartmentFormModal';

    public $department;

    protected function getRules()
    {
        return [
            'department.name' => [
                'required',
                Rule::unique(tableName('departments'), 'name')->ignore($this->department->id ?? 0)
            ],
            'department.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.department.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createDepartment()
    {
        $this->department = new Department();
        $this->authorize('create', $this->department);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateDepartment(Department $department)
    {
        $this->department = $department;
        $this->authorize('update', $this->department);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Department());
        $this->validate();

        $this->editing = false;

        $this->department->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('departmentUpdated');

        flashMessage('Department created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->department);
        $this->validate();

        $this->department->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Department Updated!', 'warning');

        $this->editing = false;

        $this->emit('departmentUpdated');
    }
}
