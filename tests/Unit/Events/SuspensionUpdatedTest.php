<?php

namespace Dainsys\HumanResourceTests\Unit\Events;

// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Events\SuspensionUpdated;
use Dainsys\HumanResource\Listeners\SuspendEmployee;
use Dainsys\HumanResource\Listeners\SendEmployeeSuspendedEmail;

class SuspensionUpdatedTest extends TestCase
{
    /** @test */
    public function suspension_saved_is_listened_ty_update_suspension()
    {
        Event::fake();
        Event::assertListening(SuspensionUpdated::class, SuspendEmployee::class);
        Event::assertListening(SuspensionUpdated::class, SendEmployeeSuspendedEmail::class);
    }
}
