<?php

namespace Dainsys\HumanResource\Tests\Services;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Services\BirthdaysService;

class BirthdaysServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;
    protected $date;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new BirthdaysService();
        $this->date = now();
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_today()
    {
        $employee_today = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()]);
        $employee_yesterday = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->subDay()]);

        $birthdays = $this->service->handle('today');

        $this->assertTrue($birthdays->contains('id', $employee_today->id));
        $this->assertFalse($birthdays->contains('id', $employee_yesterday->id));
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_yesterday()
    {
        $employee_yesterday = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->subDay()]);
        $employee_today = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()]);

        $birthdays = $this->service->handle('yesterday');

        $this->assertTrue($birthdays->contains('id', $employee_yesterday->id));
        $this->assertFalse($birthdays->contains('id', $employee_today->id));
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_tomorrow()
    {
        $employee_tomorrow = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->addDay()]);
        $employee_today = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()]);

        $birthdays = $this->service->handle('tomorrow');

        $this->assertTrue($birthdays->contains('id', $employee_tomorrow->id));
        $this->assertFalse($birthdays->contains('id', $employee_today->id));
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_this_month()
    {
        $employee_this_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->startOfMonth()]);
        $employee_last_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->subMonth()]);

        $birthdays = $this->service->handle('this_month');

        $this->assertTrue($birthdays->contains('id', $employee_this_month->id));
        $this->assertFalse($birthdays->contains('id', $employee_last_month->id));
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_last_month()
    {
        $employee_this_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()]);
        $employee_last_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->subMonth()]);

        $birthdays = $this->service->handle('last_month');

        $this->assertTrue($birthdays->contains('id', $employee_last_month->id));
        $this->assertFalse($birthdays->contains('id', $employee_this_month->id));
    }

    /** @test */
    public function birthdays_service_returns_birthdays_for_next_month()
    {
        $employee_this_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()]);
        $employee_next_month = Employee::factory()->current()->createQuietly(['date_of_birth' => $this->date->copy()->addMonth()]);

        $birthdays = $this->service->handle('next_month');

        $this->assertTrue($birthdays->contains('id', $employee_next_month->id));
        $this->assertFalse($birthdays->contains('id', $employee_this_month->id));
    }

    /** @test */
    public function birthdays_service_includes_suspended_employees()
    {
        $employee_today = Employee::factory()->suspended()->createQuietly(['date_of_birth' => $this->date->copy()]);

        $birthdays = $this->service->handle('today');

        $this->assertTrue($birthdays->contains('id', $employee_today->id));
    }

    /** @test */
    public function birthdays_service_doesnt_include_inactive_employees()
    {
        $employee_today = Employee::factory()->inactive()->createQuietly(['date_of_birth' => $this->date->copy()]);

        $birthdays = $this->service->handle('today');

        $this->assertEmpty($birthdays);
    }
}
