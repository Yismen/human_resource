<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\SuspensionType;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\SuspensionType\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspension_type_form_requires_authorization_to_create()
    {
        $suspension_type = SuspensionType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createSuspensionType', $suspension_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_type_form_requires_authorization_to_update()
    {
        $suspension_type = SuspensionType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateSuspensionType', $suspension_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_type_index_component_responds_to_wants_create_suspension_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createSuspensionType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionTypeFormModal');
    }

    /** @test */
    public function suspension_type_index_component_responds_to_wants_edit_suspension_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateSuspensionType');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionTypeFormModal');
    }

    /** @test */
    public function suspension_type_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = SuspensionType::factory()->make()->toArray();
        $component = Livewire::test(Form::class)
            ->set('suspension_type', new SuspensionType($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('suspension_typeUpdated');

        $this->assertDatabaseHas(tableName('suspension_types'), $data);
    }

    /** @test */
    public function suspension_type_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $suspension_type = SuspensionType::factory()->create(['name' => 'New SuspensionType', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('suspension_type', $suspension_type)
            ->set('suspension_type.name', 'Updated SuspensionType')
            ->set('suspension_type.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('suspension_typeUpdated');
        $this->assertDatabaseHas(tableName('suspension_types'), ['name' => 'Updated SuspensionType', 'description' => 'Updated description']);
    }

    /** @test */
    public function suspension_type_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('suspension_type', new SuspensionType($data));

        $component->call('store');
        $component->assertHasErrors(['suspension_type.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['suspension_type.name' => 'required']);
    }

    /** @test */
    public function suspension_type_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $suspension_type = SuspensionType::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('suspension_type.name', $suspension_type->name);

        $component->call('store');
        $component->assertHasErrors(['suspension_type.name' => 'unique']);

        $component->set('suspension_type', $suspension_type)->call('update');
        $component->assertHasNoErrors(['suspension_type.name' => 'unique']);
    }
}
