<?php

use Illuminate\Support\Facades\Route;
use Dainsys\HumanResource\Models\Site;

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

            Route::get('sites', \Dainsys\HumanResource\Http\Livewire\Site\Index::class)->name('sites.index')->can('viewAny', Site::class);
        });
});
