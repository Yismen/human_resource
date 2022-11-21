<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Employee;

use Livewire\Livewire;
use Illuminate\Support\Arr;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Employee\Form;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_form_requires_authorization_to_create()
    {
        $employee = Employee::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createEmployee', $employee->id);

        $component->assertForbidden();
    }

    /** @test */
    public function employee_form_requires_authorization_to_update()
    {
        $employee = Employee::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateEmployee', $employee->id);

        $component->assertForbidden();
    }

    /** @test */
    public function employee_index_component_responds_to_wants_create_employee_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createEmployee');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showEmployeeFormModal');
    }

    /** @test */
    public function employee_index_component_responds_to_wants_edit_employee_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateEmployee');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showEmployeeFormModal');
    }

    /** @test */
    public function employee_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = Employee::factory()->make()->toArray();
        $component = Livewire::test(Form::class)
            ->set('employee', new Employee($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('employeeUpdated');

        $this->assertDatabaseHas(tableName('employees'), Arr::except($data, ['full_name']));
    }

    /** @test */
    public function employee_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $employee = Employee::factory()->create(['first_name' => 'New Employee']);
        $component = Livewire::test(Form::class)
            ->set('employee', $employee)
            ->set('employee.first_name', 'Updated Employee');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('employeeUpdated');
        $this->assertDatabaseHas(tableName('employees'), ['first_name' => 'Updated Employee']);
    }

    /** @test */
    public function employee_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['first_name' => ''];
        $component = Livewire::test(Form::class)
            ->set('employee', new Employee($data));

        $component->call('store');
        $component->assertHasErrors(['employee.first_name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['employee.first_name' => 'required']);
    }
}
