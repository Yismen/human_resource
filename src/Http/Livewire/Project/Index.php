<?php

namespace Dainsys\HumanResource\Http\Livewire\Project;

use Livewire\Component;
use Dainsys\HumanResource\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Project());

        return view('human_resource::livewire.project.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
