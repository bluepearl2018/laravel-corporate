<?php

use Eutranet\Corporate\Http\Controllers\AgencyController;
use Eutranet\Corporate\Http\Controllers\CorporateController;
use Eutranet\Corporate\Http\Controllers\CorporateGeneralTermController;
use Eutranet\Corporate\Http\Controllers\ServiceFeeController;
use Eutranet\Corporate\Http\Controllers\StaffMemberController;
use Eutranet\Corporate\Http\Controllers\StaffMemberUserController;
use Eutranet\Corporate\Http\Controllers\UserController;
use Eutranet\Setup\Http\Controllers\Auth\AuthenticatedSessionController;
use Eutranet\Corporate\Http\Controllers\DashboardController;
use Eutranet\Corporate\Http\Controllers\SearchUserController;
use Eutranet\Corporate\Http\Controllers\UserMessengingController;
use Eutranet\Corporate\Http\Controllers\UserNotificationController;
use Eutranet\Corporate\Http\Controllers\NotificationTemplateController;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Http\Controllers\CorporateAgreementController;
use Eutranet\Corporate\Http\Controllers\UserPaymentController;
use Eutranet\Corporate\Http\Controllers\BackendEmailController;
use Eutranet\Corporate\Http\Controllers\AgreementController;
use Eutranet\Corporate\Http\Controllers\ContactAttemptController;
use Eutranet\Corporate\Http\Controllers\FeedbackController;
use Eutranet\Corporate\Http\Controllers\ConsultationController;

/**
 * Routes intended to gain access to the back-office as STAFF
 */
Route::middleware(['web', 'guest'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('admin/authenticate', [AuthenticatedSessionController::class, 'store'])->name('admin.authenticate');
});

Route::middleware(['web', 'auth:staff'])->prefix('admin')->name('admin.')->group(function () {

    /**
     * -----------------------------------------------------------------------------*
     * CORPORATE DASHBOARD
     * -----------------------------------------------------------------------------*
     */

    Route::redirect('/', 'dashboard')->name('back');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/my-account', [DashboardController::class, 'myAccount'])->name('my-account');

    /**
     * CORPORATE
     * -----------------------------------------------------------------------------
     *
     * Agencies have staff-members. Admins are apart.
     */

    Route::resource('agreements', AgreementController::class)->only(['index', 'show'])->names('agreements');
    Route::resource('agencies', AgencyController::class)->except(['index', 'show'])->names(['agencies.index', 'agencies.show']);
    Route::resource('corporate-agreements', CorporateAgreementController::class)->names('corporate-agreements');
    Route::resource('corporates', CorporateController::class)->names('corporates');
    Route::resource('corporate-general-terms', CorporateGeneralTermController::class)->names('corporate-general-terms');
    Route::resource('corporates.staffs', StaffMemberController::class)->names('corporates.staffs');
    Route::resource('service-fees', ServiceFeeController::class)->names('service-fees');
    Route::resource('staff-members', StaffMemberController::class)->names('staff-members');

    /**
     * -----------------------------------------------------------------------------
     * PAYMENTS
     * -----------------------------------------------------------------------------
     * Register and manage user payments.
     */
    if (Schema::hasTable('user_payments')) {
        Route::resource('users.payments', UserPaymentController::class)->names('user-payments');
    }

    /**
     * USERS with USER STATUSES
     * -----------------------------------------------------------------------------
     *
     * Agencies have staff-members. Admins are apart.
     */
    Route::post('users/find-by-nif', [SearchUserController::class, 'findByNif'])->name('users.find-by-nif');
    Route::post('users/find-by-phone-number', [SearchUserController::class, 'findByPhoneNumber'])->name('users.find-by-phone-number');
    Route::get('users/filter-by-status/{user_status}', [UserController::class, 'filterByStatusCode'])->name('users.filter-by-status');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('staff-members.users', StaffMemberUserController::class)->names('staff-members.users');
    Route::post('assign-staff-to-user', [StaffMemberUserController::class, 'store'])->name('staff-members.assign-staff-to-user');

    /**
     * MAILER
     * -----------------------------------------------------------------------------
     * Send mails to users and get access to new messages they have sent...
     * Todo create email through contact center
     */
    Route::resource('users.messages', UserMessengingController::class)->only('index', 'show', 'create', 'destroy')->names('users.messages');
    Route::post('send-message-to/{user}', [UserMessengingController::class, 'store'])->name('send-message-to-user');
    Route::post('email-staff-member/{staff_member}', function () {
        return abort('403', 'Under development');
    })->name('email-staff');
    Route::post('send-welcome-email', [BackendEmailController::class, 'sendWelcomeEmail'])->name('send-welcome-email');
    Route::post('send-general-terms', [BackendEmailController::class, 'sendGeneralTerms'])->name('send-general-terms');
    Route::post('send-question-form', [BackendEmailController::class, 'sendQuestionForm'])->name('send-question-form');
    Route::post('send-prepare-documents', [BackendEmailController::class, 'sendPrepareDocuments'])->name('send-prepare-documents');

    /**
     * NOTIFICATIONS
     * -----------------------------------------------------------------------------
     * Send mails to users and get access to new messages they have sent...
     * Todo create notification through contact center
     */
    Route::post('view-notification-template/{notification_template}/{user}', [NotificationTemplateController::class, 'viewNotificationTemplate'], function (\Eutranet\Corporate\Models\NotificationTemplate $notificationTemplate, User $user) {
    })->name('view-notification-template');
    Route::resource('users.user-notifications', UserNotificationController::class)->names('users.user-notifications');
    Route::post('notify-staff-member/{staff_member}', function () {
        return abort('403', 'Under development');
    })->name('notify-staff-member');

    Route::middleware('has-current-user')->group(function () {
        /**
         * CONTACT CENTER
         * -----------------------------------------------------------------------------
         * Generate a call from the call center...
         * Todo create phone through contact center
         */
        Route::resource('users.consultations', ConsultationController::class)->names('users.consultations');
        Route::resource('users.contact-attempts', ContactAttemptController::class)->names('users.contact-attempts');
        Route::resource('users.feedbacks', FeedbackController::class)->names('users.feedbacks');
    });

    Route::post('call-staff-member/{staff_member}', function () {
        return abort('403', 'Under development');
    })->name('call-staff');
});
