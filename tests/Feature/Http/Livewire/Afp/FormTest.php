<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Afp;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Afp\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function afp_form_requires_authorization_to_create()
    {
        $afp = Afp::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createAfp', $afp->id);

        $component->assertForbidden();
    }

    /** @test */
    public function afp_form_requires_authorization_to_update()
    {
        $afp = Afp::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateAfp', $afp->id);

        $component->assertForbidden();
    }

    /** @test */
    public function afp_index_component_responds_to_wants_create_afp_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createAfp');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showAfpFormModal');
    }

    /** @test */
    public function afp_index_component_responds_to_wants_edit_afp_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateAfp');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showAfpFormModal');
    }

    /** @test */
    public function afp_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Afp', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('afp', new Afp($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('afpUpdated');

        $this->assertDatabaseHas(tableName('afps'), $data);
    }

    /** @test */
    public function afp_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $afp = Afp::factory()->create(['name' => 'New Afp', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('afp', $afp)
            ->set('afp.name', 'Updated Afp')
            ->set('afp.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('afpUpdated');
        $this->assertDatabaseHas(tableName('afps'), ['name' => 'Updated Afp', 'description' => 'Updated description']);
    }

    /** @test */
    public function afp_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('afp', new Afp($data));

        $component->call('store');
        $component->assertHasErrors(['afp.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['afp.name' => 'required']);
    }

    /** @test */
    public function afp_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $afp = Afp::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('afp.name', $afp->name);

        $component->call('store');
        $component->assertHasErrors(['afp.name' => 'unique']);

        $component->set('afp', $afp)->call('update');
        $component->assertHasNoErrors(['afp.name' => 'unique']);
    }
}
