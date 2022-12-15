<?php

namespace Dainsys\HumanResource\Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Console\Commands\Birthdays;
use Dainsys\HumanResource\Mail\Birthdays as MailBirthdays;

class BirthdaysTest extends TestCase
{
    use RefreshDatabase;

    public function birthdays_command_run_sucessfully()
    {
        $this->artisan('human_resource:birthdays')
            ->assertSuccessful();
    }

    /** @test */
    public function birthdays_command_sends_email()
    {
        Mail::fake();
        $employee1 = Employee::factory()->current()->create(['date_of_birth' => now()]);

        $this->artisan(Birthdays::class, ['today']);

        Mail::assertQueued(MailBirthdays::class);
    }

    /** @test */
    public function birthdays_command_doesnot_send_email_if_service_is_empty()
    {
        Mail::fake();
        $employee1 = Employee::factory()->current()->create(['date_of_birth' => now()->addDay()]);

        $this->artisan(Birthdays::class, ['today']);

        Mail::assertNotQueued(MailBirthdays::class);
    }
}
