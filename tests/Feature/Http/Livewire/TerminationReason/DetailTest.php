<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationReason;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\TerminationReason;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\TerminationReason\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_reasons_detail_requires_authorization()
    {
        $termination_reasons = TerminationReason::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showTerminationReason', $termination_reasons->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_reasons_index_component_responds_to_wants_show_termination_reasons_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showTerminationReason');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationReasonDetailModal');
    }
}
