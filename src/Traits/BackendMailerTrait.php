<?php

namespace Eutranet\Corporate\Traits;

use Illuminate\Support\Facades\Mail;
use Eutranet\Corporate\Mail\NewRegistrationEmail;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Mail\HtmlMessage;

trait BackendMailerTrait
{
	public function sendHtmlMessage(Request $request): void
	{
		$sender = StaffMember::findOrFail($request->staff_member_id);
		$recipient = User::findOrFail($request->user_id);
		$rules = [
			'from' => 'email:rfc,dns',
			'to' => 'email:rfc,dns',
			'staff_member_id' => 'exists:staff_members,id',
			'user_id' => 'exists:users,id',
			'subject' => 'string|min:5|max:140',
			'message_body' => 'string|min:5|max:500',
		];
		$request->validate($rules);

		Mail::to([$sender->email, $sender->name])
			->bcc(Auth::user())
			->send(new HtmlMessage($sender, $recipient, [$request->subject, $request->message_body]));
		Flash::success('Email was sent');
	}

	public function sendWelcomeEmail(Request $request): void
	{
		$sender = StaffMember::findOrFail($request->staff_member_id);
		$recipient = User::findOrFail($request->user_id);
		$rules = [
			'staff_member_id' => 'exists:staff_members,id',
			'user_id' => 'exists:users,id',
			'subject' => 'string|min:5|max:140',
			'message_body' => 'string|min:5|max:500',
		];
		$request->validate($rules);

		Mail::to($request->user())
			->bcc(Auth::user())
			->send(new NewRegistrationEmail($sender->email, $recipient->email, [$request->subject, $request->message_body]));
		Flash::success('Email was sent');
	}
}