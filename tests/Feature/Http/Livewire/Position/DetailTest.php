<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Position;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Position;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Position\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function position_detail_requires_authorization()
    {
        $position = Position::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showPosition', $position->id);

        $component->assertForbidden();
    }

    /** @test */
    public function position_index_component_responds_to_wants_show_position_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showPosition');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPositionDetailModal');
    }
}
