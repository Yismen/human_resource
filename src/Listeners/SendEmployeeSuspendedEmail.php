<?php

namespace Dainsys\HumanResource\Listeners;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Events\SuspensionUpdated;
use Dainsys\HumanResource\Mail\SuspensionUpdated as MailSuspensionUpdated;

class SendEmployeeSuspendedEmail
{
    public function handle(SuspensionUpdated $event)
    {
        Mail::send(new MailSuspensionUpdated($event->suspension));
    }
}
