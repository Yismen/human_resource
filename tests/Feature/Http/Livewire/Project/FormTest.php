<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Project;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Project;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Project\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_form_requires_authorization_to_create()
    {
        $project = Project::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createProject', $project->id);

        $component->assertForbidden();
    }

    /** @test */
    public function project_form_requires_authorization_to_update()
    {
        $project = Project::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateProject', $project->id);

        $component->assertForbidden();
    }

    /** @test */
    public function project_index_component_responds_to_wants_create_project_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createProject');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showProjectFormModal');
    }

    /** @test */
    public function project_index_component_responds_to_wants_edit_project_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateProject');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showProjectFormModal');
    }

    /** @test */
    public function project_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Project', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('project', new Project($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('projectUpdated');

        $this->assertDatabaseHas(tableName('projects'), $data);
    }

    /** @test */
    public function project_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $project = Project::factory()->create(['name' => 'New Project', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('project', $project)
            ->set('project.name', 'Updated Project')
            ->set('project.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('projectUpdated');
        $this->assertDatabaseHas(tableName('projects'), ['name' => 'Updated Project', 'description' => 'Updated description']);
    }

    /** @test */
    public function project_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('project', new Project($data));

        $component->call('store');
        $component->assertHasErrors(['project.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['project.name' => 'required']);
    }

    /** @test */
    public function project_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $project = Project::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('project.name', $project->name);

        $component->call('store');
        $component->assertHasErrors(['project.name' => 'unique']);

        $component->set('project', $project)->call('update');
        $component->assertHasNoErrors(['project.name' => 'unique']);
    }
}
