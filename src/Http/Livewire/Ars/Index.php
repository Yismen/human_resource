<?php

namespace Dainsys\HumanResource\Http\Livewire\Ars;

use Livewire\Component;
use Dainsys\HumanResource\Models\Ars;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Ars());

        return view('human_resource::livewire.ars.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
