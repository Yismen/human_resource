<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Bank;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Bank;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Bank\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bank_detail_requires_authorization()
    {
        $bank = Bank::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showBank', $bank->id);

        $component->assertForbidden();
    }

    /** @test */
    public function bank_index_component_responds_to_wants_show_bank_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showBank');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showBankDetailModal');
    }
}
