<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationType;

use Livewire\Component;
use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new TerminationType());

        return view('human_resource::livewire.termination_type.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
