<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Supervisor;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Supervisor\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function supervisor_detail_requires_authorization()
    {
        $supervisor = Supervisor::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showSupervisor', $supervisor->id);

        $component->assertForbidden();
    }

    /** @test */
    public function supervisor_index_component_responds_to_wants_show_supervisor_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showSupervisor');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSupervisorDetailModal');
    }
}
