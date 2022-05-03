<?php

namespace Eutranet\Corporate\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\User;
use Eutranet\Setup\Models\Email;

class NewRegistrationEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StaffMember $sender, User $recipient, array $message)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('corporate::mails.new-registration', [
            'from' => [$this->sender->email, $this->sender->name],
            'to' => [$this->recipient->email, $this->recipient->name],
            'subject' => __('Your account is ready !'),
            'message_body' => $this->message[1]
        ]);
    }
}
