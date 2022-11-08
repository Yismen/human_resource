<?php

namespace Dainsys\HumanResource\Http\Livewire\Project;

use Livewire\Component;
use Dainsys\HumanResource\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showProject',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showProjectDetailModal';

    public $project;

    public function render()
    {
        return view('human_resource::livewire.project.detail', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function showProject(Project $project)
    {
        $this->authorize('view', $project);

        $this->editing = false;
        $this->project = $project;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
