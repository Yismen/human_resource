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

            Route::get('departments', \Dainsys\HumanResource\Http\Livewire\Department\Index::class)->name('departments.index')->can('viewAny', \Dainsys\HumanResource\Models\Department::class);
            Route::get('payment_types', \Dainsys\HumanResource\Http\Livewire\PaymentType\Index::class)->name('payment_types.index')->can('viewAny', \Dainsys\HumanResource\Models\PaymentType::class);
            Route::get('projects', \Dainsys\HumanResource\Http\Livewire\Project\Index::class)->name('projects.index')->can('viewAny', \Dainsys\HumanResource\Models\Project::class);
            Route::get('sites', \Dainsys\HumanResource\Http\Livewire\Site\Index::class)->name('sites.index')->can('viewAny', \Dainsys\HumanResource\Models\Site::class);
        });
});
