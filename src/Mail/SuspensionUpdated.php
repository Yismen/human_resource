<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Report\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Dainsys\HumanResource\Models\Suspension;

class SuspensionUpdated extends Mailable
{
    use Queueable;
    use SerializesModels;

    public Suspension $suspension;

    public function __construct(Suspension $suspension)
    {
        $this->suspension = $suspension;
    }

    public function build()
    {
        return $this
            ->to(Report::recipients($this))
            ->markdown('human_resource::mail.suspension-updated');
    }
}
