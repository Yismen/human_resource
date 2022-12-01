<?php

namespace Dainsys\HumanResource\Feature\Http\Livewire\Employee;

use Livewire\Livewire;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Http\Livewire\Employee\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        
        Event::fake();
    }

    /** @test */
    public function employee_detail_requires_authorization()
    {
        $employee = Employee::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showEmployee', $employee->id);

        $component->assertForbidden();
    }

    /** @test */
    public function employee_index_component_responds_to_wants_show_employee_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showEmployee');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showEmployeeDetailModal');
    }
}
