<?php

namespace Dainsys\HumanResource\Http\Livewire\Suspension;

use Livewire\Component;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Suspension());

        return view('human_resource::livewire.suspension.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
