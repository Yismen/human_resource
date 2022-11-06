<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Site;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Site\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function site_detail_requires_authorization()
    {
        $site = Site::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showSite', $site->id);

        $component->assertForbidden();
    }

    /** @test */
    public function site_index_component_responds_to_wants_show_site_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showSite');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSiteDetailModal');
    }
}
