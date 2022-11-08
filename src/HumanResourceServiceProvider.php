<?php

namespace Dainsys\HumanResource;

use Livewire\Livewire;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Dainsys\HumanResource\Console\Commands\InstallCommand;
use Dainsys\HumanResource\Contracts\AuthorizedUsersContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class HumanResourceServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        \Dainsys\HumanResource\Models\Department::class => \Dainsys\HumanResource\Policies\DepartmentPolicy::class,
        \Dainsys\HumanResource\Models\Project::class => \Dainsys\HumanResource\Policies\ProjectPolicy::class,
        \Dainsys\HumanResource\Models\Site::class => \Dainsys\HumanResource\Policies\SitePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Model::preventLazyLoading(true);
        Paginator::useBootstrap();

        $this->bootPublishableAssets();
        $this->bootLoads();
        $this->bootLivewireComponents();

        if ($this->app->runningInConsole() && !app()->isProduction()) {
            $this->commands([
                InstallCommand::class
            ]);
        }

        Gate::define('interact-with-admin', function (\Illuminate\Foundation\Auth\User $user) {
            return resolve(AuthorizedUsersContract::class)
                ->has($user->email);
        });
    }

    public function register()
    {
        $this->app->singleton(\Dainsys\HumanResource\Contracts\AuthorizedUsersContract::class, function ($app) {
            return new \Dainsys\HumanResource\Support\AuthorizedUsers();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/human_resource.php',
            'human_resource'
        );
    }

    protected function bootPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/human_resource.php' => config_path('human_resource.php')
        ], 'human_resource:config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dainsys/human_resource')
        ], 'human_resource:views');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/dainsys/human_resource'),
        ], 'human_resource:assets');
    }

    protected function bootLoads()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'human_resource');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function bootLivewireComponents()
    {
        Livewire::component('human_resource::dashboard', \Dainsys\HumanResource\Http\Livewire\Admin\Dashboard::class);

        Livewire::component('human_resource::citizenship.table', \Dainsys\HumanResource\Http\Livewire\Citizenship\Table::class);
        Livewire::component('human_resource::citizenship.index', \Dainsys\HumanResource\Http\Livewire\Citizenship\Index::class);
        Livewire::component('human_resource::citizenship.detail', \Dainsys\HumanResource\Http\Livewire\Citizenship\Detail::class);
        Livewire::component('human_resource::citizenship.form', \Dainsys\HumanResource\Http\Livewire\Citizenship\Form::class);

        Livewire::component('human_resource::department.table', \Dainsys\HumanResource\Http\Livewire\Department\Table::class);
        Livewire::component('human_resource::department.index', \Dainsys\HumanResource\Http\Livewire\Department\Index::class);
        Livewire::component('human_resource::department.detail', \Dainsys\HumanResource\Http\Livewire\Department\Detail::class);
        Livewire::component('human_resource::department.form', \Dainsys\HumanResource\Http\Livewire\Department\Form::class);

        Livewire::component('human_resource::project.table', \Dainsys\HumanResource\Http\Livewire\Project\Table::class);
        Livewire::component('human_resource::project.index', \Dainsys\HumanResource\Http\Livewire\Project\Index::class);
        Livewire::component('human_resource::project.detail', \Dainsys\HumanResource\Http\Livewire\Project\Detail::class);
        Livewire::component('human_resource::project.form', \Dainsys\HumanResource\Http\Livewire\Project\Form::class);

        Livewire::component('human_resource::payment_type.table', \Dainsys\HumanResource\Http\Livewire\PaymentType\Table::class);
        Livewire::component('human_resource::payment_type.index', \Dainsys\HumanResource\Http\Livewire\PaymentType\Index::class);
        Livewire::component('human_resource::payment_type.detail', \Dainsys\HumanResource\Http\Livewire\PaymentType\Detail::class);
        Livewire::component('human_resource::payment_type.form', \Dainsys\HumanResource\Http\Livewire\PaymentType\Form::class);

        Livewire::component('human_resource::site.table', \Dainsys\HumanResource\Http\Livewire\Site\Table::class);
        Livewire::component('human_resource::site.index', \Dainsys\HumanResource\Http\Livewire\Site\Index::class);
        Livewire::component('human_resource::site.detail', \Dainsys\HumanResource\Http\Livewire\Site\Detail::class);
        Livewire::component('human_resource::site.form', \Dainsys\HumanResource\Http\Livewire\Site\Form::class);

        Livewire::component('human_resource::supervisor.table', \Dainsys\HumanResource\Http\Livewire\Supervisor\Table::class);
        Livewire::component('human_resource::supervisor.index', \Dainsys\HumanResource\Http\Livewire\Supervisor\Index::class);
        Livewire::component('human_resource::supervisor.detail', \Dainsys\HumanResource\Http\Livewire\Supervisor\Detail::class);
        Livewire::component('human_resource::supervisor.form', \Dainsys\HumanResource\Http\Livewire\Supervisor\Form::class);
    }
}
