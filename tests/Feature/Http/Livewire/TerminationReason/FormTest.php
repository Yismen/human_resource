<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\TerminationReason;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Models\TerminationReason;
use Dainsys\HumanResource\Http\Livewire\TerminationReason\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_reasons_form_requires_authorization_to_create()
    {
        $termination_reasons = TerminationReason::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationReason', $termination_reasons->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_reasons_form_requires_authorization_to_update()
    {
        $termination_reasons = TerminationReason::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationReason', $termination_reasons->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_reasons_index_component_responds_to_wants_create_termination_reasons_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createTerminationReason');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationReasonFormModal');
    }

    /** @test */
    public function termination_reasons_index_component_responds_to_wants_edit_termination_reasons_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateTerminationReason');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationReasonFormModal');
    }

    /** @test */
    public function termination_reasons_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New TerminationReason', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('termination_reason', new TerminationReason($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationReasonUpdated');

        $this->assertDatabaseHas(tableName('termination_reasons'), $data);
    }

    /** @test */
    public function termination_reasons_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $termination_reasons = TerminationReason::factory()->create(['name' => 'New TerminationReason', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('termination_reason', $termination_reasons)
            ->set('termination_reason.name', 'Updated TerminationReason')
            ->set('termination_reason.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationReasonUpdated');
        $this->assertDatabaseHas(tableName('termination_reasons'), ['name' => 'Updated TerminationReason', 'description' => 'Updated description']);
    }

    /** @test */
    public function termination_reasons_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('termination_reason', new TerminationReason($data));

        $component->call('store');
        $component->assertHasErrors(['termination_reason.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['termination_reason.name' => 'required']);
    }

    /** @test */
    public function termination_reasons_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $termination_reasons = TerminationReason::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('termination_reason.name', $termination_reasons->name);

        $component->call('store');
        $component->assertHasErrors(['termination_reason.name' => 'unique']);

        $component->set('termination_reason', $termination_reasons)->call('update');
        $component->assertHasNoErrors(['termination_reason.name' => 'unique']);
    }
}
