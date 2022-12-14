<?php

namespace Dainsys\HumanResource\Http\Livewire\Citizenship;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Citizenship;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createCitizenship',
        'updateCitizenship',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showCitizenshipFormModal';

    public $citizenship;

    protected function getRules()
    {
        return [
            'citizenship.name' => [
                'required',
                Rule::unique(tableName('citizenships'), 'name')->ignore($this->citizenship->id ?? 0)
            ],
            'citizenship.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.citizenship.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createCitizenship()
    {
        $this->citizenship = new Citizenship();
        $this->authorize('create', $this->citizenship);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateCitizenship(Citizenship $citizenship)
    {
        $this->citizenship = $citizenship;
        $this->authorize('update', $this->citizenship);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Citizenship());
        $this->validate();

        $this->editing = false;

        $this->citizenship->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('citizenshipUpdated');

        flashMessage('Citizenship created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->citizenship);
        $this->validate();

        $this->citizenship->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Citizenship Updated!', 'warning');

        $this->editing = false;

        $this->emit('citizenshipUpdated');
    }
}
