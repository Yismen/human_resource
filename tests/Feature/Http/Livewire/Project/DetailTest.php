<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Project;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Project;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Project\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_detail_requires_authorization()
    {
        $project = Project::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showProject', $project->id);

        $component->assertForbidden();
    }

    /** @test */
    public function project_index_component_responds_to_wants_show_project_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showProject');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showProjectDetailModal');
    }
}
