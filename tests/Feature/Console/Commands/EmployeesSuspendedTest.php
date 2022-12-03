<?php

namespace Dainsys\HumanResource\Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Console\Commands\EmployeesSuspended;

class EmployeesSuspendedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employees_suspended_run_sucessfully()
    {
        $this->artisan('human_resource:employees-suspended')
            ->assertSuccessful();
    }

    /** @test */
    public function employees_suspended_sends_email()
    {
        Mail::fake();
        $current = Employee::factory()->createQuietly();
        Suspension::factory()->createQuietly([
            'employee_id' => $current->id,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
        ]);
        $current->update(['status' => EmployeeStatus::SUSPENDED]);

        $this->artisan(EmployeesSuspended::class);

        Mail::assertSent(\Dainsys\HumanResource\Mail\EmployeesSuspended::class);
    }

    /** @test */
    public function employees_suspended_does_not_sends_email_if_there_is_not_employees_suspended()
    {
        Mail::fake();
        $current = Employee::factory()->current()->createQuietly();

        $this->artisan(EmployeesSuspended::class);

        Mail::assertNotSent(\Dainsys\HumanResource\Mail\EmployeesSuspended::class);
    }
}
