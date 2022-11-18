<?php

namespace Dainsys\HumanResource\Http\Livewire\Information;

use Livewire\Component;
use Dainsys\HumanResource\Models\Information;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dainsys\HumanResource\Contracts\InstanceFromNameContract;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createInformation',
        'updateInformation',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showInformationFormModal';

    public $information;
    public $model;

    protected function getRules()
    {
        return [
            'information.phone' => [
                'required',
            ],
            'information.email' => [
                'nullable',
                'email',
                'min:5'
            ],
            'information.photo_url' => [
                'nullable',
            ],
            'information.address' => [
                'nullable',
            ],
            'information.company_id' => [
                'nullable',
            ],
            'information.informationable_id' => [
                'nullable'
            ],
            'information.informationable_type' => [
                'nullable'
            ],
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.information.form');
    }

    public function createInformation(string $modelName, int $modelId, InstanceFromNameContract $guesser)
    {
        $model = $guesser->get($modelName);
        $this->authorize('create', $model);

        $this->model = $model->find($modelId);
        $this->information = new Information();
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateInformation(Information $information)
    {
        $this->information = $information;
        $this->authorize('update', $this->information);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Information());
        $this->validate();

        $this->editing = false;
        $this->model->information()->create($this->information->toArray());

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('informationUpdated');

        flashMessage('Information created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->information);
        $this->validate();

        $this->information->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->editing = false;

        $this->emit('informationUpdated');

        flashMessage('Information Updated!', 'warning');
    }
}
