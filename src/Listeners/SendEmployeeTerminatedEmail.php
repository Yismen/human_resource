<?php

namespace Dainsys\HumanResource\Listeners;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Events\TerminationCreated;
use Dainsys\HumanResource\Mail\TerminationCreated as MailTerminationCreated;

class SendEmployeeTerminatedEmail
{
    public function handle(TerminationCreated $event)
    {
        Mail::send(new MailTerminationCreated($event->termination));
    }
}
