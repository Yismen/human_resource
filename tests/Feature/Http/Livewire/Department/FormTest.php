<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Department;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Department;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Department\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function department_form_requires_authorization_to_create()
    {
        $department = Department::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createDepartment', $department->id);

        $component->assertForbidden();
    }

    /** @test */
    public function department_form_requires_authorization_to_update()
    {
        $department = Department::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateDepartment', $department->id);

        $component->assertForbidden();
    }

    /** @test */
    public function department_index_component_responds_to_wants_create_department_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createDepartment');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showDepartmentFormModal');
    }

    /** @test */
    public function department_index_component_responds_to_wants_edit_department_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateDepartment');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showDepartmentFormModal');
    }

    /** @test */
    public function department_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Department', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('department', new Department($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('departmentUpdated');

        $this->assertDatabaseHas(tableName('departments'), $data);
    }

    /** @test */
    public function department_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $department = Department::factory()->create(['name' => 'New Department', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('department', $department)
            ->set('department.name', 'Updated Department')
            ->set('department.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('departmentUpdated');
        $this->assertDatabaseHas(tableName('departments'), ['name' => 'Updated Department', 'description' => 'Updated description']);
    }

    /** @test */
    public function department_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('department', new Department($data));

        $component->call('store');
        $component->assertHasErrors(['department.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['department.name' => 'required']);
    }

    /** @test */
    public function department_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $department = Department::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('department.name', $department->name);

        $component->call('store');
        $component->assertHasErrors(['department.name' => 'unique']);

        $component->set('department', $department)->call('update');
        $component->assertHasNoErrors(['department.name' => 'unique']);
    }
}
