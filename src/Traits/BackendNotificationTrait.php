<?php

namespace Eutranet\Corporate\Traits;

use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Notifications\SelectedTemplateNotification;
use Eutranet\Corporate\Models\NotificationTemplate;

/**
 * A collection of notification functions for the backend staff
 */
trait BackendNotificationTrait
{


	/**
	 * @param User $user
	 * @param NotificationTemplate $notificationTemplate
	 * @param StaffMember|null $staffMember
	 * @return void
	 */
	public function notificationAction(User $user, NotificationTemplate $notificationTemplate, ?StaffMember $staffMember)
	{
		$user->notify(new SelectedTemplateNotification($user, $notificationTemplate, $staffMember));
	}
}