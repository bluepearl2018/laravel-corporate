<?php

/**
 * -----------------------------------------------------------------------------*
 * CORPORATE CONFIG ROUTES
 * -----------------------------------------------------------------------------*
 */

Route::middleware(['web', 'auth:admin'])->get('/setup/corporate/config', function () {
    return view('corporate::config');
})->name('setup.corporate.config');
