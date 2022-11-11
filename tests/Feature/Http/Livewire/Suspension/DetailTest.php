<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Suspension;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Suspension;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Suspension\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspension_detail_requires_authorization()
    {
        $suspension = Suspension::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showSuspension', $suspension->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_index_component_responds_to_wants_show_suspension_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showSuspension');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionDetailModal');
    }
}
