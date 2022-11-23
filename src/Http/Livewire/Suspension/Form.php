<?php

namespace Dainsys\HumanResource\Http\Livewire\Suspension;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension;
use Dainsys\HumanResource\Models\SuspensionType;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createSuspension',
        'updateSuspension',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showSuspensionFormModal';

    public $suspension;

    protected function getRules()
    {
        return [
            'suspension.employee_id' => [
                'required',
                Rule::exists(Employee::class, 'id')
            ],
            'suspension.suspension_type_id' => [
                'required',
                Rule::exists(SuspensionType::class, 'id'),
            ],
            'suspension.starts_at' => [
                'required',
                'date',
            ],
            'suspension.ends_at' => [
                'required',
                'date',
            ],
            'suspension.comments' => [
                'nullable',
            ],
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.suspension.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createSuspension()
    {
        $this->suspension = new Suspension();
        $this->authorize('create', $this->suspension);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateSuspension(Suspension $suspension)
    {
        $this->suspension = $suspension;
        $this->authorize('update', $this->suspension);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Suspension());
        $this->validate();

        $this->editing = false;

        $this->suspension->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('suspensionUpdated');

        flashMessage('Suspension created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->suspension);
        $this->validate();

        $this->suspension->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Suspension Updated!', 'warning');

        $this->editing = false;

        $this->emit('suspensionUpdated');
    }
}
