<?php

namespace Dainsys\HumanResource\Http\Livewire\SuspensionType;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\SuspensionType;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createSuspensionType',
        'updateSuspensionType',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showSuspensionTypeFormModal';

    public $suspension_type;

    protected function getRules()
    {
        return [
            'suspension_type.name' => [
                'required',
                Rule::unique(tableName('suspension_types'), 'name')->ignore($this->suspension_type->id ?? 0)
            ],
            'suspension_type.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.suspension_type.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createSuspensionType()
    {
        $this->suspension_type = new SuspensionType();
        $this->authorize('create', $this->suspension_type);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateSuspensionType(SuspensionType $suspension_type)
    {
        $this->suspension_type = $suspension_type;
        $this->authorize('update', $this->suspension_type);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new SuspensionType());
        $this->validate();

        $this->editing = false;

        $this->suspension_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('suspension_typeUpdated');

        flashMessage('SuspensionType created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->suspension_type);
        $this->validate();

        $this->suspension_type->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('SuspensionType Updated!', 'warning');

        $this->editing = false;

        $this->emit('suspension_typeUpdated');
    }
}
