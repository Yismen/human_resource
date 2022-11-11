<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationType;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\TerminationType\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_type_form_requires_authorization_to_create()
    {
        $termination_type = TerminationType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationType', $termination_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_type_form_requires_authorization_to_update()
    {
        $termination_type = TerminationType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationType', $termination_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_type_index_component_responds_to_wants_create_termination_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationTypeFormModal');
    }

    /** @test */
    public function termination_type_index_component_responds_to_wants_edit_termination_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationType');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationTypeFormModal');
    }

    /** @test */
    public function termination_type_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New TerminationType', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('termination_type', new TerminationType($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('termination_typeUpdated');

        $this->assertDatabaseHas(tableName('termination_types'), $data);
    }

    /** @test */
    public function termination_type_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $termination_type = TerminationType::factory()->create(['name' => 'New TerminationType', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('termination_type', $termination_type)
            ->set('termination_type.name', 'Updated TerminationType')
            ->set('termination_type.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('termination_typeUpdated');
        $this->assertDatabaseHas(tableName('termination_types'), ['name' => 'Updated TerminationType', 'description' => 'Updated description']);
    }

    /** @test */
    public function termination_type_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('termination_type', new TerminationType($data));

        $component->call('store');
        $component->assertHasErrors(['termination_type.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['termination_type.name' => 'required']);
    }

    /** @test */
    public function termination_type_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $termination_type = TerminationType::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('termination_type.name', $termination_type->name);

        $component->call('store');
        $component->assertHasErrors(['termination_type.name' => 'unique']);

        $component->set('termination_type', $termination_type)->call('update');
        $component->assertHasNoErrors(['termination_type.name' => 'unique']);
    }
}
