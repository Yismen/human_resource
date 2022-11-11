<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Project;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Project\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function projects_index_route_requires_authentication()
    {
        $response = $this->get(route('human_resource.admin.projects.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function projects_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('human_resource.admin.projects.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function projects_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('human_resource.admin.projects.index'));

        $response->assertOk();
    }

    /** @test */
    public function project_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function project_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('human_resource::livewire.project.index');
    }
}
