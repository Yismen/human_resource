<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\SuspensionType;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\SuspensionType;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\SuspensionType\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspension_type_detail_requires_authorization()
    {
        $suspension_type = SuspensionType::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showSuspensionType', $suspension_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_type_index_component_responds_to_wants_show_suspension_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showSuspensionType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionTypeDetailModal');
    }
}
