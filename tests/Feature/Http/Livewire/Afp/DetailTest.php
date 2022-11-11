<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Afp;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Afp\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function afp_detail_requires_authorization()
    {
        $afp = Afp::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showAfp', $afp->id);

        $component->assertForbidden();
    }

    /** @test */
    public function afp_index_component_responds_to_wants_show_afp_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showAfp');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showAfpDetailModal');
    }
}
