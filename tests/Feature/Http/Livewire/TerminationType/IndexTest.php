<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationType;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\TerminationType\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function terminationtypes_index_route_requires_authentication()
    {
        $response = $this->get(route('human_resource.admin.termination_types.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function terminationtypes_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('human_resource.admin.terminationtypes.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function terminationtypes_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('human_resource.admin.termination_types.index'));

        $response->assertOk();
    }

    /** @test */
    public function terminationtype_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function terminationtype_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('human_resource::livewire.termination_type.index');
    }
}
