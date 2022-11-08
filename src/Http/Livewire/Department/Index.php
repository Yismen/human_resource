<?php

namespace Dainsys\HumanResource\Http\Livewire\Department;

use Livewire\Component;
use Dainsys\HumanResource\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Department());

        return view('human_resource::livewire.department.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
