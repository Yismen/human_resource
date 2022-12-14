<?php

namespace Dainsys\HumanResource\Console\Commands;

use Illuminate\Console\Command;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;
use Dainsys\HumanResource\Services\EmployeesNeedingSuspension;
use Dainsys\HumanResource\Services\EmployeesNeedingRemoveSuspension;

class UpdateEmployeeSuspensions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'human_resource:update-employee-suspensions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if employees\'s status needs to be updated based on suspensions.';

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
        $shouldSuspend = EmployeesNeedingSuspension::list();
        $shouldActivate = EmployeesNeedingRemoveSuspension::list();

        $shouldSuspendCount = $shouldSuspend->count();
        $shouldActivateCount = $shouldActivate->count();

        if ($shouldSuspendCount) {
            $shouldSuspend->each->updateQuietly(['status' => EmployeeStatus::SUSPENDED]);
            $this->info("{$shouldSuspendCount} employees suspended!");
        }

        if ($shouldActivateCount) {
            $shouldActivate->each->updateQuietly(['status' => EmployeeStatus::CURRENT]);
            $this->info("{$shouldActivateCount} suspended employees activated!");
        }

        if ($shouldActivateCount === 0 && $shouldActivateCount === 0) {
            $this->warn('No status change needed for employees!');
        }

        return 0;
    }
}
