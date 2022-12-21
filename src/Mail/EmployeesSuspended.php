<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Mailing\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeesSuspended extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function build()
    {
        return $this
            ->to(Mailing::recipients($this))
            ->markdown('human_resource::mail.employees-suspended');
    }
}
