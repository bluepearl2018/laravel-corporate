<?php

/**
 * -----------------------------------------------------------------------------*
 * CORPORATE FRONTEND ROUTES
 * -----------------------------------------------------------------------------*
 * All web routes MUST be called after the 'web' middleware
 * Otherwise, errors, eloquent models... won't be magically displayed
 */

Route::middleware(['web'])->group(function () {
});
