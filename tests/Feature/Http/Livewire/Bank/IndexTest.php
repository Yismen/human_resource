<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Bank;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Bank\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function banks_index_route_requires_authentication()
    {
        $response = $this->get(route('human_resource.admin.banks.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function banks_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('human_resource.admin.banks.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function banks_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('human_resource.admin.banks.index'));

        $response->assertOk();
    }

    /** @test */
    public function bank_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function bank_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('human_resource::livewire.bank.index');
    }
}
