<?php

namespace Dainsys\HumanResource\Http\Livewire\Bank;

use Livewire\Component;
use Dainsys\HumanResource\Models\Bank;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Bank());

        return view('human_resource::livewire.bank.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
