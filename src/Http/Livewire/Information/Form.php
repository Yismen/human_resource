<?php

namespace Dainsys\HumanResource\Http\Livewire\Information;

use Livewire\Component;
use Livewire\WithFileUploads;
use Dainsys\HumanResource\Models\Information;
use Dainsys\HumanResource\Traits\WithPhotoUpload;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dainsys\HumanResource\Contracts\InstanceFromNameContract;

class Form extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use WithPhotoUpload;
    use WithRealTimeValidation;

    protected $listeners = [
        'createInformation',
        'updateInformation',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showInformationFormModal';

    public $information;
    public $model;
    public $photo;

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
            'photo' => [
                'nullable',
                'image',
                'max:1024'
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

    public function createInformation($modelName, int $modelId, InstanceFromNameContract $guesser)
    {
        $this->reset(['photo']);
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
        $this->reset(['photo']);
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
        $data = array_merge(
            $this->information->toArray(),
            ['photo_url' => $this->updatePhoto($this->model, 'informations')]
        );

        $this->model->information()->create($data);
        $this->reset(['photo']);

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('informationUpdated');

        flashMessage('Information created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->information);
        $this->validate();

        $model = (new $this->information->informationable_type())->find($this->information->informationable_id);

        if ($this->photo) {
            $this->information->photo_url = $this->updatePhoto($model, 'informations');
        }

        $this->information->save();
        $this->reset(['photo']);

        $this->dispatchBrowserEvent('closeAllModals');

        $this->editing = false;

        $this->emit('informationUpdated');

        flashMessage('Information Updated!', 'warning');
    }
}
