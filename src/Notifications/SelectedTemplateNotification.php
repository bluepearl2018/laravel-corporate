<?php

namespace Eutranet\Corporate\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Models\NotificationTemplate;

/**
 * Send manual user-notifications from templates
 */
class SelectedTemplateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, NotificationTemplate $notificationTemplate, ?StaffMember $staffMember)
    {
        $this->user = $user;
        $this->staffMember = $staffMember;
        $this->notificationTemplate = $notificationTemplate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line('Hello ' . $this->user->name)
            ->line($this->notificationTemplate->message)
            ->action($this->notificationTemplate->action, url($this->notificationTemplate->url))
            ->line(__('Kind regards,'))
            ->line(config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            // Will be used to avoid notifiy twice for the same reason...
            'notification_template_id' => $this->notificationTemplate->id,
        ];
    }
}
