<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Position;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Position;
use Dainsys\HumanResource\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Position\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function position_form_requires_authorization_to_create()
    {
        $position = Position::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createPosition', $position->id);

        $component->assertForbidden();
    }

    /** @test */
    public function position_form_requires_authorization_to_update()
    {
        $position = Position::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updatePosition', $position->id);

        $component->assertForbidden();
    }

    /** @test */
    public function position_index_component_responds_to_wants_create_position_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createPosition');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPositionFormModal');
    }

    /** @test */
    public function position_index_component_responds_to_wants_edit_position_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updatePosition');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPositionFormModal');
    }

    /** @test */
    public function position_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = Position::factory()->make()->toArray();
        $component = Livewire::test(Form::class)
            ->set('position', new Position($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('positionUpdated');

        $this->assertDatabaseHas(tableName('positions'), $data);
    }

    /** @test */
    public function position_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $position = Position::factory()->create();
        $component = Livewire::test(Form::class)
            ->set('position', $position)
            ->set('position.name', 'Updated Position')
            ->set('position.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('positionUpdated');
        $this->assertDatabaseHas(tableName('positions'), ['name' => 'Updated Position', 'description' => 'Updated description']);
    }

    /** @test */
    public function position_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('position', new Position($data));

        $component->call('store');
        $component->assertHasErrors(['position.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['position.name' => 'required']);
    }

    /** @test */
    public function position_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $position = Position::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('position.name', $position->name);

        $component->call('store');
        $component->assertHasErrors(['position.name' => 'unique']);

        $component->set('position', $position)->call('update');
        $component->assertHasNoErrors(['position.name' => 'unique']);
    }
}
