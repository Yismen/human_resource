<?php

namespace Dainsys\HumanResource\Console\Commands;

use Illuminate\Console\Command;
use Dainsys\HumanResource\Models\Site;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'human_resource:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Dainsys HumanResource';

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
        // $name = $this->ask('Please enter company name');
        // $super_user_email = $this->ask('Please enter super user email address');

        // if (Site::count() > 0) {
        //     throw new \Exception('Only one company allowed! Visit company profile and update. ', 419);
        // }

        // Site::create(compact('name', 'super_user_email'));

        return 0;
    }
}
