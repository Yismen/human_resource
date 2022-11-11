<?php

namespace Dainsys\HumanResource\Http\Livewire\Position;

use Livewire\Component;
use Dainsys\HumanResource\Models\Position;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Position());

        return view('human_resource::livewire.position.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
