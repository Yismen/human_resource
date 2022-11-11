<?php

namespace Dainsys\HumanResource\Http\Livewire\Position;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Position;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createPosition',
        'updatePosition',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showPositionFormModal';

    public $position;

    protected function getRules()
    {
        return [
            'position.name' => [
                'required',
                Rule::unique(tableName('positions'), 'name')->ignore($this->position->id ?? 0)
            ],
            'position.department_id' => [
                'required',
                Rule::exists(tableName('departments'), 'id')
            ],
            'position.payment_type_id' => [
                'required',
                Rule::exists(tableName('payment_types'), 'id')
            ],
            'position.salary' => [
                'required',
                'numeric',
                'min:0',
                'max:1000000',
            ],
            'position.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.position.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createPosition()
    {
        $this->position = new Position();
        $this->authorize('create', $this->position);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updatePosition(Position $position)
    {
        $this->position = $position;
        $this->authorize('update', $this->position);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Position());
        $this->validate();

        $this->editing = false;

        $this->position->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('positionUpdated');

        flashMessage('Position created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->position);
        $this->validate();

        $this->position->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Position Updated!', 'warning');

        $this->editing = false;

        $this->emit('positionUpdated');
    }
}
