<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Supervisor;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Supervisor\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function supervisor_form_requires_authorization_to_create()
    {
        $supervisor = Supervisor::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createSupervisor', $supervisor->id);

        $component->assertForbidden();
    }

    /** @test */
    public function supervisor_form_requires_authorization_to_update()
    {
        $supervisor = Supervisor::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateSupervisor', $supervisor->id);

        $component->assertForbidden();
    }

    /** @test */
    public function supervisor_index_component_responds_to_wants_create_supervisor_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createSupervisor');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSupervisorFormModal');
    }

    /** @test */
    public function supervisor_index_component_responds_to_wants_edit_supervisor_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateSupervisor');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSupervisorFormModal');
    }

    /** @test */
    public function supervisor_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Supervisor', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('supervisor', new Supervisor($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('supervisorUpdated');

        $this->assertDatabaseHas(tableName('supervisors'), $data);
    }

    /** @test */
    public function supervisor_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $supervisor = Supervisor::factory()->create(['name' => 'New Supervisor', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('supervisor', $supervisor)
            ->set('supervisor.name', 'Updated Supervisor')
            ->set('supervisor.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('supervisorUpdated');
        $this->assertDatabaseHas(tableName('supervisors'), ['name' => 'Updated Supervisor', 'description' => 'Updated description']);
    }

    /** @test */
    public function supervisor_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('supervisor', new Supervisor($data));

        $component->call('store');
        $component->assertHasErrors(['supervisor.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['supervisor.name' => 'required']);
    }

    /** @test */
    public function supervisor_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $supervisor = Supervisor::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('supervisor.name', $supervisor->name);

        $component->call('store');
        $component->assertHasErrors(['supervisor.name' => 'unique']);

        $component->set('supervisor', $supervisor)->call('update');
        $component->assertHasNoErrors(['supervisor.name' => 'unique']);
    }
}
