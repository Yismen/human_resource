<?php

namespace Dainsys\HumanResource\Http\Livewire\SuspensionType;

use Livewire\Component;
use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new SuspensionType());

        return view('human_resource::livewire.suspension_type.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
