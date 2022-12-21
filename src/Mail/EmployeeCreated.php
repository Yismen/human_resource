<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Mailing\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeCreated extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function build()
    {
        return $this
            ->to(Mailing::recipients($this))
            ->markdown('human_resource::mail.employee-created');
    }
}
