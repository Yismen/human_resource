<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Site;

use Livewire\Livewire;
use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Http\Livewire\Site\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function site_form_requires_authorization_to_create()
    {
        $site = Site::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createSite', $site->id);

        $component->assertForbidden();
    }

    /** @test */
    public function site_form_requires_authorization_to_update()
    {
        $site = Site::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateSite', $site->id);

        $component->assertForbidden();
    }

    /** @test */
    public function site_index_component_responds_to_wants_create_site_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createSite');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSiteFormModal');
    }

    /** @test */
    public function site_index_component_responds_to_wants_edit_site_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateSite');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showSiteFormModal');
    }

    /** @test */
    public function site_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Site', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('site', new Site($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('siteUpdated');

        $this->assertDatabaseHas(tableName('sites'), $data);
    }

    /** @test */
    public function site_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $site = Site::factory()->create(['name' => 'New Site', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('site', $site)
            ->set('site.name', 'Updated Site')
            ->set('site.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('siteUpdated');
        $this->assertDatabaseHas(tableName('sites'), ['name' => 'Updated Site', 'description' => 'Updated description']);
    }

    /** @test */
    public function site_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('site', new Site($data));

        $component->call('store');
        $component->assertHasErrors(['site.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['site.name' => 'required']);
    }

    /** @test */
    public function site_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $site = Site::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('site.name', $site->name);

        $component->call('store');
        $component->assertHasErrors(['site.name' => 'unique']);

        $component->set('site', $site)->call('update');
        $component->assertHasNoErrors(['site.name' => 'unique']);
    }
}
