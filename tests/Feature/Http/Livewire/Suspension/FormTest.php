<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Suspension;

use Livewire\Livewire;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Suspension\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspension_form_requires_authorization_to_create()
    {
        $suspension = Suspension::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->emit('createSuspension', $suspension->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_form_requires_authorization_to_update()
    {
        $suspension = Suspension::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->emit('updateSuspension', $suspension->id);

        $component->assertForbidden();
    }

    /** @test */
    public function suspension_index_component_responds_to_wants_create_suspension_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createSuspension');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionFormModal');
    }

    /** @test */
    public function suspension_index_component_responds_to_wants_edit_suspension_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateSuspension');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSuspensionFormModal');
    }

    /** @test */
    public function suspension_index_component_create_new_record()
    {
        Event::fake();
        $this->withAuthorizedUser();
        $data = Suspension::factory()->make()->toArray();
        $component = Livewire::test(Form::class)
            ->set('suspension', new Suspension($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('suspensionUpdated');

        $this->assertDatabaseHas(tableName('suspensions'), $data);
    }

    /** @test */
    public function suspension_index_component_update_record()
    {
        Mail::fake();
        $this->withAuthorizedUser();
        $suspension = Suspension::factory()->createQuietly();
        $component = Livewire::test(Form::class)
            ->set('suspension', $suspension)
            ->set('suspension.starts_at', now()->subDay())
            ->set('suspension.comments', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('suspensionUpdated');
        $this->assertDatabaseHas(tableName('suspensions'), ['starts_at' => now()->subDay()->format('Y-m-d'), 'comments' => 'Updated description']);
    }

    /** @test */
    // public function suspension_index_component_validates_required_fields()
    // {
    //     $this->withAuthorizedUser();
    //     $data = ['starts_at' => ''];
    //     $component = Livewire::test(Form::class)
    //         ->set('suspension', new Suspension($data));

    //     $component->call('store');
    //     $component->assertHasErrors(['suspension.starts_at' => 'required']);

    //     $component->call('update');
    //     $component->assertHasErrors(['suspension.starts_at' => 'required']);
    // }
}
