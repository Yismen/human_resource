<?php

namespace Dainsys\HumanResourceTests\Unit\Events;

// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Events\SuspensionCreated;
use Dainsys\HumanResource\Listeners\UpdateFullName;
use Dainsys\HumanResource\Listeners\SuspendEmployee;

class SuspensionCreatedTest extends TestCase
{
    /** @test */
    public function employee_saved_is_listened_ty_update_full_name()
    {
        Event::fake();
        Event::assertListening(SuspensionCreated::class, SuspendEmployee::class);
    }
}
