<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Ars;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Ars\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ars_form_requires_authorization_to_create()
    {
        $ars = Ars::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createArs', $ars->id);

        $component->assertForbidden();
    }

    /** @test */
    public function ars_form_requires_authorization_to_update()
    {
        $ars = Ars::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateArs', $ars->id);

        $component->assertForbidden();
    }

    /** @test */
    public function ars_index_component_responds_to_wants_create_ars_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createArs');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showArsFormModal');
    }

    /** @test */
    public function ars_index_component_responds_to_wants_edit_ars_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateArs');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showArsFormModal');
    }

    /** @test */
    public function ars_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Ars', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('ars', new Ars($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('arsUpdated');

        $this->assertDatabaseHas(tableName('arss'), $data);
    }

    /** @test */
    public function ars_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $ars = Ars::factory()->create(['name' => 'New Ars', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('ars', $ars)
            ->set('ars.name', 'Updated Ars')
            ->set('ars.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('arsUpdated');
        $this->assertDatabaseHas(tableName('arss'), ['name' => 'Updated Ars', 'description' => 'Updated description']);
    }

    /** @test */
    public function ars_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('ars', new Ars($data));

        $component->call('store');
        $component->assertHasErrors(['ars.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['ars.name' => 'required']);
    }

    /** @test */
    public function ars_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $ars = Ars::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('ars.name', $ars->name);

        $component->call('store');
        $component->assertHasErrors(['ars.name' => 'unique']);

        $component->set('ars', $ars)->call('update');
        $component->assertHasNoErrors(['ars.name' => 'unique']);
    }
}
