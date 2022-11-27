<?php

namespace Dainsys\HumanResource\Console\Commands;

use Illuminate\Console\Command;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

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
        $suspensions = Suspension::query()
            ->with(['employee'])
            ->whereHas('employee', function($query) {
                $query->where('status', '<>', EmployeeStatus::INACTIVE);
            })
            ->get()
            ->each->changeEmployeeStatus();



        return 0;
    }
}
