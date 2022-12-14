<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Report\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeesSuspended extends Mailable
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
            ->to(Report::recipients($this))
            ->markdown('human_resource::mail.employees-suspended');
    }
}
