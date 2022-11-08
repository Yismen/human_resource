<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Citizenship;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Citizenship\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function citizenships_index_route_requires_authentication()
    {
        $response = $this->get(route('human_resource.admin.citizenships.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function citizenships_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('human_resource.admin.citizenships.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function citizenships_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('human_resource.admin.citizenships.index'));

        $response->assertOk();
    }

    /** @test */
    public function citizenship_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function citizenship_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('human_resource::livewire.citizenship.index');
    }
}
