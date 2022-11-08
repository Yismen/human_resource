<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Citizenship;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Citizenship;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Citizenship\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function citizenship_detail_requires_authorization()
    {
        $citizenship = Citizenship::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showCitizenship', $citizenship->id);

        $component->assertForbidden();
    }

    /** @test */
    public function citizenship_index_component_responds_to_wants_show_citizenship_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showCitizenship');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showCitizenshipDetailModal');
    }
}
