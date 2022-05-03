<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Models\NotificationTemplate;
use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Acces the notification templates and notify
 */
class NotificationTemplateController extends Controller
{
    /**
     * @param NotificationTemplate $notificationTemplate
     * @param User|null $user
     * @return Application|Factory|View
     */
    public function show(NotificationTemplate $notificationTemplate, ?User $user): View|Factory|Application
    {
        return view('corporate::notification-templates.show', ['notificationTemplate' => $notificationTemplate, 'user' => $user]);
    }

    /**
     * @param NotificationTemplate $notificationTemplate
     * @param User|null $user
     * @return View|Factory|Application
     */
    public function viewNotificationTemplate(NotificationTemplate $notificationTemplate, ?User $user): View|Factory|Application
    {
        return view('corporate::notification-templates.show', ['notificationTemplate' => $notificationTemplate, 'user' => $user]);
    }
}
