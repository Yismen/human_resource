<?php

namespace Dainsys\HumanResource\Http\Livewire\Termination;

use Livewire\Component;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Termination());

        return view('human_resource::livewire.termination.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
