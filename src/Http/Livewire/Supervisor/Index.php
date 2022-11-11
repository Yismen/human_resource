<?php

namespace Dainsys\HumanResource\Http\Livewire\Supervisor;

use Livewire\Component;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Supervisor());

        return view('human_resource::livewire.supervisor.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
