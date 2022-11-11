<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Ars;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Ars\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ars_detail_requires_authorization()
    {
        $ars = Ars::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showArs', $ars->id);

        $component->assertForbidden();
    }

    /** @test */
    public function ars_index_component_responds_to_wants_show_ars_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showArs');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showArsDetailModal');
    }
}
