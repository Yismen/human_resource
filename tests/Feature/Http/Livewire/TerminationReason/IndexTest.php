<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationReason;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\TerminationReason\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_reasons_index_route_requires_authentication()
    {
        $response = $this->get(route('human_resource.admin.termination_reasons.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function termination_reasons_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('human_resource.admin.termination_reasons.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function termination_reasons_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('human_resource.admin.termination_reasons.index'));

        $response->assertOk();
    }

    /** @test */
    public function termination_reasons_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_reasons_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('human_resource::livewire.termination_reason.index');
    }
}
