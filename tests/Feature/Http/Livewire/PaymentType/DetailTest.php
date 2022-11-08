<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\PaymentType;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\PaymentType\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function payment_type_detail_requires_authorization()
    {
        $payment_type = PaymentType::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showPaymentType', $payment_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function payment_type_index_component_responds_to_wants_show_payment_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showPaymentType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPaymentTypeDetailModal');
    }
}
