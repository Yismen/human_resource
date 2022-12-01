<?php

namespace Dainsys\HumanResource\Listeners;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Events\SuspensionCreated;
use Dainsys\HumanResource\Mail\SuspensionCreated as MailSuspensionCreated;

class SendEmployeeSuspendedEmail
{
    public function handle(SuspensionCreated $event)
    {
        Mail::send(new MailSuspensionCreated($event->suspension));
    }
}
