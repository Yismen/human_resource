<?php

namespace Dainsys\HumanResource\Console\Commands;

use Illuminate\Console\Command;
use Dainsys\Mailing\Console\Commands\InstallCommand as CommandsInstallCommand;
use Asantibanez\LivewireCharts\Console\InstallCommand as ConsoleInstallCommand;

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
        if (app()->runningInConsole() && app()->isLocal()) {
            $this->call(ConsoleInstallCommand::class);
            $this->call(CommandsInstallCommand::class);
        }

        $this->call('vendor:publish', ['--tag' => 'human_resource:assets', '--force' => true]);

        if ($this->confirm('Would you like to run the migrations now?')) {
            $this->call('migrate');
        }

        if ($this->confirm('Would you like to publish the configuration file?')) {
            $this->call('vendor:publish', ['--tag' => 'human_resource:config']);
        }

        if ($this->confirm('Would you like to publish the translation file?')) {
            $this->call('vendor:publish', ['--tag' => 'human_resource:translations']);
        }

        if ($this->confirm('Would you like to publish the view files?')) {
            $this->call('vendor:publish', ['--tag' => 'human_resource:views']);
        }

        $this->info('All done!');

        return 0;
    }
}
