<?php

use Dainsys\HumanResource\Models\Form;
use Dainsys\HumanResource\Models\Entry;
use Dainsys\HumanResource\Models\Response;
use Illuminate\Support\Facades\Route;
use Dainsys\HumanResource\Http\Resources\FormResource;
use Dainsys\HumanResource\Http\Resources\EntryResource;

Route::middleware(['api'])->group(function () {
    // Auth Routes
    Route::as('dainsys.human_resource.api.')
        ->prefix('dainsys/human_resource/api')
        ->middleware(
            preg_split('/[,|]+/', config('human_resource.midlewares.api'), -1, PREG_SPLIT_NO_EMPTY)
        )->group(function () {
            // Route::get('form/{form}', function ($form) {
            //     return new FormResource(Form::with('responses')->find($form));
            // })->name('form.show');
            // Route::get('entries/{entry}', function ($entry) {
            //     return new EntryResource(Entry::with('form', 'responses')->findOrFail($entry));
            // })->name('entries.show');
            // Route::get('responses/entry/{entry}', ['data' => 'response by entry'])->name('responses.entry.show');
        });
});
