<?php

use Eutranet\Corporate\Http\Controllers\CorporateAgreementController;
use Eutranet\Corporate\Http\Controllers\AgencyController;
use Eutranet\Corporate\Http\Controllers\CorporateController;
use Eutranet\Corporate\Http\Controllers\CorporateGeneralTermController;
use Eutranet\Frontend\Http\Controllers\ServiceController;
use Eutranet\Corporate\Http\Controllers\ServiceFeeController;
use Eutranet\Corporate\Http\Controllers\StaffMemberUserController;
use Eutranet\Corporate\Http\Controllers\ConsultationController;
use Eutranet\Corporate\Http\Controllers\ContactAttemptController;
use Eutranet\Corporate\Http\Controllers\FeedbackController;
use Eutranet\Corporate\Http\Controllers\CorporateStaffMemberController;
use Eutranet\Corporate\Http\Controllers\StaffTeamController;
use Eutranet\Corporate\Http\Controllers\TeamController;

/**
 * -----------------------------------------------------------------------------*
 * CORPORATE SETUP ROUTES
 * -----------------------------------------------------------------------------*
 */

Route::middleware(['web', 'auth:admin'])->name('setup.')->prefix('setup')->group(function () {
    Route::resource('agencies', AgencyController::class)->names('agencies');
    Route::resource('consultations', ConsultationController::class)->names('consultations');
    Route::resource('contact-attempts', ContactAttemptController::class)->names('contact-attempts');
    Route::resource('corporates', CorporateController::class)->names('corporates');
    Route::resource('corporate-agreements', CorporateAgreementController::class)->names('corporate-agreements');
    Route::resource('corporate-staff-member', CorporateStaffMemberController::class)->names('corporate-staff-member');
    Route::resource('corporate-general-terms', CorporateGeneralTermController::class)->names('corporate-general-terms');
    Route::resource('feedbacks', FeedbackController::class)->names('feedbacks');
    Route::resource('services', ServiceController::class)->names('services');
    Route::resource('service-fees', ServiceFeeController::class)->names('service-fees');
    Route::resource('staff-teams', StaffTeamController::class)->names('staff-teams');
    Route::resource('staff-member-users', StaffMemberUserController::class)->names('staff-member-users');
    Route::resource('teams', TeamController::class)->names('teams');
});
