<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Citizenship;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Citizenship\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function citizenship_form_requires_authorization_to_create()
    {
        $citizenship = Citizenship::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createCitizenship', $citizenship->id);

        $component->assertForbidden();
    }

    /** @test */
    public function citizenship_form_requires_authorization_to_update()
    {
        $citizenship = Citizenship::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateCitizenship', $citizenship->id);

        $component->assertForbidden();
    }

    /** @test */
    public function citizenship_index_component_responds_to_wants_create_citizenship_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createCitizenship');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showCitizenshipFormModal');
    }

    /** @test */
    public function citizenship_index_component_responds_to_wants_edit_citizenship_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateCitizenship');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showCitizenshipFormModal');
    }

    /** @test */
    public function citizenship_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Citizenship', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('citizenship', new Citizenship($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('citizenshipUpdated');

        $this->assertDatabaseHas(tableName('citizenships'), $data);
    }

    /** @test */
    public function citizenship_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $citizenship = Citizenship::factory()->create(['name' => 'New Citizenship', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('citizenship', $citizenship)
            ->set('citizenship.name', 'Updated Citizenship')
            ->set('citizenship.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('citizenshipUpdated');
        $this->assertDatabaseHas(tableName('citizenships'), ['name' => 'Updated Citizenship', 'description' => 'Updated description']);
    }

    /** @test */
    public function citizenship_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('citizenship', new Citizenship($data));

        $component->call('store');
        $component->assertHasErrors(['citizenship.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['citizenship.name' => 'required']);
    }

    /** @test */
    public function citizenship_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $citizenship = Citizenship::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('citizenship.name', $citizenship->name);

        $component->call('store');
        $component->assertHasErrors(['citizenship.name' => 'unique']);

        $component->set('citizenship', $citizenship)->call('update');
        $component->assertHasNoErrors(['citizenship.name' => 'unique']);
    }
}
