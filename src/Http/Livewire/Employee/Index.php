<?php

namespace Dainsys\HumanResource\Http\Livewire\Employee;

use Livewire\Component;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Employee());

        return view('human_resource::livewire.employee.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
