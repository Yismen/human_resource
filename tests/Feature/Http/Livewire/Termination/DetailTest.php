<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Termination;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Termination\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_detail_requires_authorization()
    {
        $termination = Termination::factory()->createQuietly();
        $component = Livewire::test(Detail::class)
            ->emit('showTermination', $termination->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_index_component_responds_to_wants_show_termination_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showTermination');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationDetailModal');
    }
}
