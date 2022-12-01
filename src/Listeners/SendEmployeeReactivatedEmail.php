<?php

namespace Dainsys\HumanResource\Listeners;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Events\EmployeeReactivated;
use Dainsys\HumanResource\Mail\EmployeeReactivated as MailEmployeeReactivated;

class SendEmployeeReactivatedEmail
{
    public function handle(EmployeeReactivated $event)
    {
        Mail::send(new MailEmployeeReactivated($event->employee));
    }
}
