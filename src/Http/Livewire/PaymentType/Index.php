<?php

namespace Dainsys\HumanResource\Http\Livewire\PaymentType;

use Livewire\Component;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new PaymentType());

        return view('human_resource::livewire.payment_type.index', [
        ])
        ->layout('human_resource::layouts.app');
    }
}
