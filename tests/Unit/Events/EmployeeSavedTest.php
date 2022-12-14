<?php

namespace Dainsys\HumanResourceTests\Unit\Events;

// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Events\EmployeeSaved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Listeners\UpdateFullName;

class EmployeeSavedTest extends TestCase
{
    /** @test */
    public function employee_saved_is_listened_ty_update_full_name()
    {
        Event::fake();
        Event::assertListening(EmployeeSaved::class, UpdateFullName::class);
    }
}
