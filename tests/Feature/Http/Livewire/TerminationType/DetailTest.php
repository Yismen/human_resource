<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationType;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\TerminationType\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_type_detail_requires_authorization()
    {
        $termination_type = TerminationType::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showTerminationType', $termination_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_type_index_component_responds_to_wants_show_termination_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showTerminationType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationTypeDetailModal');
    }
}
