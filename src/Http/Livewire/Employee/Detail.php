<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showEmployee',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showEmployeeDetailModal';

    public $employee;

    public function render()
    {
        return view('human_resource::livewire.employee.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showEmployee(Employee $employee)
    {
        $this->authorize('view', $employee);

        $this->editing = false;
        $this->employee = $employee;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
