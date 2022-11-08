<?php

namespace Dainsys\HumanResource\Http\Livewire\Project;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'createProject',
        'updateProject',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showProjectFormModal';

    public $project;

    protected function getRules()
    {
        return [
            'project.name' => [
                'required',
                Rule::unique(tableName('projects'), 'name')->ignore($this->project->id ?? 0)
            ],
            'project.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.project.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createProject()
    {
        $this->project = new Project();
        $this->authorize('create', $this->project);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateProject(Project $project)
    {
        $this->project = $project;
        $this->authorize('update', $this->project);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Project());
        $this->validate();

        $this->editing = false;

        $this->project->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('projectUpdated');

        flashMessage('Project created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->project);
        $this->validate();

        $this->project->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Project Updated!', 'warning');

        $this->editing = false;

        $this->emit('projectUpdated');
    }
}
