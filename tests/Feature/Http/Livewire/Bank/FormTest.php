<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Bank;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Bank;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Bank\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bank_form_requires_authorization_to_create()
    {
        $bank = Bank::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createBank', $bank->id);

        $component->assertForbidden();
    }

    /** @test */
    public function bank_form_requires_authorization_to_update()
    {
        $bank = Bank::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateBank', $bank->id);

        $component->assertForbidden();
    }

    /** @test */
    public function bank_index_component_responds_to_wants_create_bank_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createBank');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showBankFormModal');
    }

    /** @test */
    public function bank_index_component_responds_to_wants_edit_bank_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateBank');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showBankFormModal');
    }

    /** @test */
    public function bank_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Bank', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('bank', new Bank($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('bankUpdated');

        $this->assertDatabaseHas(tableName('banks'), $data);
    }

    /** @test */
    public function bank_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $bank = Bank::factory()->create(['name' => 'New Bank', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('bank', $bank)
            ->set('bank.name', 'Updated Bank')
            ->set('bank.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('bankUpdated');
        $this->assertDatabaseHas(tableName('banks'), ['name' => 'Updated Bank', 'description' => 'Updated description']);
    }

    /** @test */
    public function bank_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('bank', new Bank($data));

        $component->call('store');
        $component->assertHasErrors(['bank.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['bank.name' => 'required']);
    }

    /** @test */
    public function bank_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $bank = Bank::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('bank.name', $bank->name);

        $component->call('store');
        $component->assertHasErrors(['bank.name' => 'unique']);

        $component->set('bank', $bank)->call('update');
        $component->assertHasNoErrors(['bank.name' => 'unique']);
    }
}
