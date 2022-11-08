<?php

namespace Dainsys\HumanResource\Http\Livewire\Department;

use Livewire\Component;
use Dainsys\HumanResource\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showDepartment',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showDepartmentDetailModal';

    public $department;

    public function render()
    {
        return view('human_resource::livewire.department.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showDepartment(Department $department)
    {
        $this->authorize('view', $department);

        $this->editing = false;
        $this->department = $department;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
