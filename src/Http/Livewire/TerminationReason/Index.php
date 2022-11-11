<?php

namespace Dainsys\HumanResource\Http\Livewire\TerminationReason;

use Livewire\Component;
use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new TerminationReason());

        return view('human_resource::livewire.termination_reason.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
