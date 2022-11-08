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
    public function terminationtype_form_requires_authorization_to_create()
    {
        $terminationtype = TerminationType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationType', $terminationtype->id);

        $component->assertForbidden();
    }

    /** @test */
    public function terminationtype_form_requires_authorization_to_update()
    {
        $terminationtype = TerminationType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationType', $terminationtype->id);

        $component->assertForbidden();
    }

    /** @test */
    public function terminationtype_index_component_responds_to_wants_create_terminationtype_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationTypeFormModal');
    }

    /** @test */
    public function terminationtype_index_component_responds_to_wants_edit_terminationtype_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationType');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationTypeFormModal');
    }

    /** @test */
    public function terminationtype_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New TerminationType', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('terminationtype', new TerminationType($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationtypeUpdated');

        $this->assertDatabaseHas(tableName('termination_types'), $data);
    }

    /** @test */
    public function terminationtype_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $terminationtype = TerminationType::factory()->create(['name' => 'New TerminationType', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('terminationtype', $terminationtype)
            ->set('terminationtype.name', 'Updated TerminationType')
            ->set('terminationtype.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationtypeUpdated');
        $this->assertDatabaseHas(tableName('termination_types'), ['name' => 'Updated TerminationType', 'description' => 'Updated description']);
    }

    /** @test */
    public function terminationtype_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('terminationtype', new TerminationType($data));

        $component->call('store');
        $component->assertHasErrors(['terminationtype.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['terminationtype.name' => 'required']);
    }

    /** @test */
    public function terminationtype_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $terminationtype = TerminationType::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('terminationtype.name', $terminationtype->name);

        $component->call('store');
        $component->assertHasErrors(['terminationtype.name' => 'unique']);

        $component->set('terminationtype', $terminationtype)->call('update');
        $component->assertHasNoErrors(['terminationtype.name' => 'unique']);
    }
}
