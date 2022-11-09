<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    // Guest Routes
    Route::as('human_resource.')
    ->prefix('human_resource')
    ->group(function () {
        Route::get('about', \Dainsys\HumanResource\Http\Controllers\AboutController::class)->name('about');
    });
    // Auth Routes
    Route::as('human_resource.admin.')
        ->prefix(config('human_resource.routes_prefix.admin'))
        ->middleware(
            preg_split('/[,|]+/', config('human_resource.midlewares.web'), -1, PREG_SPLIT_NO_EMPTY)
        )->group(function () {
            Route::get('dashboard', function () {})->name('dashboard.index');

            Route::get('afps', \Dainsys\HumanResource\Http\Livewire\Afp\Index::class)
                ->name('afps.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Afp::class);
            Route::get('arss', \Dainsys\HumanResource\Http\Livewire\Ars\Index::class)
                ->name('arss.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Ars::class);
            Route::get('banks', \Dainsys\HumanResource\Http\Livewire\Bank\Index::class)
                ->name('banks.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Bank::class);
            Route::get('citizenships', \Dainsys\HumanResource\Http\Livewire\Citizenship\Index::class)
                ->name('citizenships.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Citizenship::class);
            Route::get('departments', \Dainsys\HumanResource\Http\Livewire\Department\Index::class)
                ->name('departments.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Department::class);
            Route::get('employees', \Dainsys\HumanResource\Http\Livewire\Employee\Index::class)
                ->name('employees.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Employee::class);
            Route::get('payment_types', \Dainsys\HumanResource\Http\Livewire\PaymentType\Index::class)
                ->name('payment_types.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\PaymentType::class);
            Route::get('projects', \Dainsys\HumanResource\Http\Livewire\Project\Index::class)
                ->name('projects.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Project::class);
            Route::get('positions', \Dainsys\HumanResource\Http\Livewire\Position\Index::class)
                ->name('positions.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Position::class);
            Route::get('sites', \Dainsys\HumanResource\Http\Livewire\Site\Index::class)
                ->name('sites.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Site::class);
            Route::get('suspension_types', \Dainsys\HumanResource\Http\Livewire\SuspensionType\Index::class)
                ->name('suspension_types.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\SuspensionType::class);
            Route::get('termination_types', \Dainsys\HumanResource\Http\Livewire\TerminationType\Index::class)
                ->name('termination_types.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\TerminationType::class);
            Route::get('termination_reasons', \Dainsys\HumanResource\Http\Livewire\TerminationReason\Index::class)
                ->name('termination_reasons.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\TerminationReason::class);
            Route::get('supervisors', \Dainsys\HumanResource\Http\Livewire\Supervisor\Index::class)
                ->name('supervisors.index')
                ->can('viewAny', \Dainsys\HumanResource\Models\Supervisor::class);
        });
});
