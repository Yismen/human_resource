<?php

namespace Dainsys\HumanResource\Http\Livewire\Citizenship;

use Livewire\Component;
use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Citizenship());

        return view('human_resource::livewire.citizenship.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
