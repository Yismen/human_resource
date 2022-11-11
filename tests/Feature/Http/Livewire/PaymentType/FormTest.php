<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\PaymentType;

use Livewire\Livewire;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\PaymentType\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function payment_type_form_requires_authorization_to_create()
    {
        $payment_type = PaymentType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createPaymentType', $payment_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function payment_type_form_requires_authorization_to_update()
    {
        $payment_type = PaymentType::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updatePaymentType', $payment_type->id);

        $component->assertForbidden();
    }

    /** @test */
    public function payment_type_index_component_responds_to_wants_create_payment_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createPaymentType');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPaymentTypeFormModal');
    }

    /** @test */
    public function payment_type_index_component_responds_to_wants_edit_payment_type_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updatePaymentType');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showPaymentTypeFormModal');
    }

    /** @test */
    public function payment_type_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New PaymentType', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('payment_type', new PaymentType($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('payment_typeUpdated');

        $this->assertDatabaseHas(tableName('payment_types'), $data);
    }

    /** @test */
    public function payment_type_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $payment_type = PaymentType::factory()->create(['name' => 'New PaymentType', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('payment_type', $payment_type)
            ->set('payment_type.name', 'Updated PaymentType')
            ->set('payment_type.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('payment_typeUpdated');
        $this->assertDatabaseHas(tableName('payment_types'), ['name' => 'Updated PaymentType', 'description' => 'Updated description']);
    }

    /** @test */
    public function payment_type_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('payment_type', new PaymentType($data));

        $component->call('store');
        $component->assertHasErrors(['payment_type.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['payment_type.name' => 'required']);
    }

    /** @test */
    public function payment_type_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $payment_type = PaymentType::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('payment_type.name', $payment_type->name);

        $component->call('store');
        $component->assertHasErrors(['payment_type.name' => 'unique']);

        $component->set('payment_type', $payment_type)->call('update');
        $component->assertHasNoErrors(['payment_type.name' => 'unique']);
    }
}
