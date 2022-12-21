<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Mailing\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Dainsys\HumanResource\Models\Termination;

class TerminationCreated extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Termination $termination;

    public function __construct(Termination $termination)
    {
        $this->termination = $termination;
    }

    public function build()
    {
        return $this
            ->to(Mailing::recipients($this))
            ->markdown('human_resource::mail.termination-created');
    }
}
