<?php

namespace Dainsys\HumanResource\Http\Livewire\Afp;

use Livewire\Component;
use Dainsys\HumanResource\Models\Afp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Afp());

        return view('human_resource::livewire.afp.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
