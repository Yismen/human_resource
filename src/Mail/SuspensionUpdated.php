<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Mailing\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Dainsys\HumanResource\Models\Suspension;

class SuspensionUpdated extends Mailable implements ShouldQueue
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
            ->to(Mailing::recipients($this))
            ->markdown('human_resource::mail.suspension-updated');
    }
}
