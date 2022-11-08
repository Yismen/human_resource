<?php

namespace Dainsys\HumanResource\Http\Livewire\Supervisor;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createSupervisor',
        'updateSupervisor',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showSupervisorFormModal';

    public $supervisor;

    protected function getRules()
    {
        return [
            'supervisor.name' => [
                'required',
                Rule::unique(tableName('supervisors'), 'name')->ignore($this->supervisor->id ?? 0)
            ],
            'supervisor.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.supervisor.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createSupervisor()
    {
        $this->supervisor = new Supervisor();
        $this->authorize('create', $this->supervisor);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateSupervisor(Supervisor $supervisor)
    {
        $this->supervisor = $supervisor;
        $this->authorize('update', $this->supervisor);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Supervisor());
        $this->validate();

        $this->editing = false;

        $this->supervisor->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('supervisorUpdated');

        flashMessage('Supervisor created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->supervisor);
        $this->validate();

        $this->supervisor->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Supervisor Updated!', 'warning');

        $this->editing = false;

        $this->emit('supervisorUpdated');
    }
}
