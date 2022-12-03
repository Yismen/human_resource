<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Termination;

use Livewire\Livewire;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Termination\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_form_requires_authorization_to_create()
    {
        $termination = Termination::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->emit('createTermination', $termination->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_form_requires_authorization_to_update()
    {
        $termination = Termination::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->emit('updateTermination', $termination->id);

        $component->assertForbidden();
    }

    /** @test */
    public function termination_index_component_responds_to_wants_create_termination_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createTermination');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationFormModal');
    }

    /** @test */
    public function termination_index_component_responds_to_wants_edit_termination_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateTermination');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showTerminationFormModal');
    }

    /** @test */
    public function termination_index_component_create_new_record()
    {
        Event::fake();
        $this->withAuthorizedUser();
        $data = Termination::factory()->make()->toArray();
        $component = Livewire::test(Form::class)
            ->set('termination', new Termination($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationUpdated');

        $this->assertDatabaseHas(tableName('terminations'), $data);
    }

    /** @test */
    public function termination_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $termination = Termination::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->set('termination', $termination)
            ->set('termination.date', now()->subDay())
            ->set('termination.comments', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('terminationUpdated');
        $this->assertDatabaseHas(tableName('terminations'), ['date' => now()->subDay()->format('Y-m-d'), 'comments' => 'Updated description']);
    }

    /** @test */
    public function termination_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['date' => null];
        $component = Livewire::test(Form::class)
            ->set('termination', new Termination($data));

        $component->call('store');
        $component->assertHasErrors(['termination.date' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['termination.date' => 'required']);
    }
}
