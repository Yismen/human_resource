<?php

namespace Dainsys\HumanResource\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Mail\EmployeesSuspended as MailEmployeesSuspended;

class EmployeesSuspended extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'human_resource:employees-suspended';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily report with the employees in status suspended, with the start and end date.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call(UpdateEmployeeSuspensions::class);

        $employees = \Dainsys\HumanResource\Models\Employee::query()
            ->with([
                'site',
                'project',
                'suspensions' => fn ($query) => $query->active()
            ])
            ->where('status', EmployeeStatus::SUSPENDED)
            ->whereHas('suspensions', function ($query) {
                $query->active();
            })
            ->get();

        if ($employees->count() > 0) {
            Mail::send(new MailEmployeesSuspended($employees));
            $this->info('Employees suspended report sent');
        } else {
            $this->warn('Nothing to send!');
        }

        return 0;
    }
}
