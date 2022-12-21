<?php

namespace Dainsys\HumanResource\Mail;

use Dainsys\Mailing\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Birthdays extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Collection $birthdays;

    public string $type;

    public function __construct(Collection $birthdays, string $type)
    {
        $this->birthdays = $birthdays;
        $this->type = $type;
    }

    public function build()
    {
        return $this
            ->subject("Birthdays {$this->type}")
            ->to(Mailing::recipients($this))
            ->markdown('human_resource::mail.birthdays');
    }
}
