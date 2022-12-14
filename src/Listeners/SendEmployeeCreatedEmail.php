<?php

namespace Dainsys\HumanResource\Listeners;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Events\EmployeeCreated;
use Dainsys\HumanResource\Mail\EmployeeCreated as MailEmployeeCreated;

class SendEmployeeCreatedEmail
{
    public function handle(EmployeeCreated $event)
    {
        Mail::send(new MailEmployeeCreated($event->employee));
    }
}
