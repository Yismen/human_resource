<?php

namespace Dainsys\HumanResource\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('human_resource::livewire.dashboard', [
        ])
            ->layout(config('human_resource.layout'));
    }
}
