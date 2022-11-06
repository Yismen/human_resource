<?php

namespace Dainsys\HumanResource\Http\Livewire\Site;

use Livewire\Component;
use Dainsys\HumanResource\Models\Site;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Site());
        
        return view('human_resource::livewire.site.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
