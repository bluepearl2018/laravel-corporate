<?php

namespace Eutranet\Corporate\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\User;
use Eutranet\Setup\Models\Email;

class HtmlMessage extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StaffMember $staffMember, User $user, array $message)
    {
        $this->sender = $staffMember;
        $this->recipient = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('theme::components.mails.template')
        ->with('title', $this->message[0])
        ->with('email', $this->recipient->email)
        ->with('user', $this->recipient);
    }
}
