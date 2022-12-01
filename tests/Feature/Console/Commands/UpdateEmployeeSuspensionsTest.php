<?php

namespace Dainsys\HumanResource\Tests\Feature\Console\Commands;

use Dainsys\Report\Models\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Console\Commands\UpdateEmployeeSuspensions;

class UpdateEmployeeSuspensionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function install_command_creates_site()
    {
        $this->artisan('human_resource:update-employee-suspensions')
            ->assertSuccessful();
    }

    /** @test */
    public function current_employees_are_suspended()
    {

        $current = Employee::factory()->createQuietly();
        Suspension::factory()->createQuietly([
            'employee_id' => $current->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
        ]);
        $current->update(['status' => EmployeeStatus::CURRENT]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::SUSPENDED,
        ]);
    }

    /** @test */
    public function inactive_employees_are_not_suspended()
    {
        $current = Employee::factory()->inactive()->createQuietly();
        Suspension::factory()->create([
            'employee_id' => $current->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
        ]);
        $current->update(['status' => EmployeeStatus::INACTIVE]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::INACTIVE,
        ]);
    }

    /** @test */
    public function inactive_employees_should_not_be_suspended()
    {
        $inactive = Employee::factory()->inactive()->createQuietly();

        Suspension::factory()->create([
            'employee_id' => $inactive->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
        ]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseMissing(tableName('employees'), [
            'id' => $inactive->id,
            'status' => EmployeeStatus::SUSPENDED,
        ]);
    }

    /** @test */
    public function employee_is_not_suspended_if_starts_at_is_before_now()
    {
        $current = Employee::factory()->createQuietly();
        Suspension::factory()->create([
            'employee_id' => $current->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay(),
        ]);
        $current->update(['status' => EmployeeStatus::CURRENT]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::CURRENT,
        ]);
    }

    /** @test */
    public function employee_is_not_suspended_if_ends_at_is_after_now()
    {
        $current = Employee::factory()->createQuietly();
        Suspension::factory()->create([
            'employee_id' => $current->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->subDay(),
        ]);
        $current->update(['status' => EmployeeStatus::CURRENT]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::CURRENT,
        ]);
    }

    /** @test */
    public function suspended_employees_are_activated_if_today_is_prior_to_starts_at()
    {
        $current = Employee::factory()->suspended()->createQuietly();
        Suspension::factory()->create([
            'employee_id' => $current->id,
            'starts_at' => now()->addDay(),
            'ends_at' => now()->addDay(),
        ]);
        $current->update(['status' => EmployeeStatus::SUSPENDED]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::CURRENT,
        ]);
    }

    /** @test */
    public function suspended_employees_are_activated_if_today_is_after_ends_at()
    {
        $current = Employee::factory()->suspended()->createQuietly();
        Suspension::factory()->create([
            'employee_id' => $current->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->subDay(),
        ]);
        $current->update(['status' => EmployeeStatus::SUSPENDED]);

        $this->artisan(UpdateEmployeeSuspensions::class);

        $this->assertDatabaseHas(tableName('employees'), [
            'id' => $current->id,
            'status' => EmployeeStatus::CURRENT,
        ]);
    }
}
